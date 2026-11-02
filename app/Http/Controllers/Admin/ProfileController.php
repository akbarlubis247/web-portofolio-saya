<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioSetting;
use App\Services\SupabaseMedia;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $settings = PortfolioSetting::current();

        return view('admin.profile.edit', compact('settings'));
    }

    public function update(Request $request, SupabaseMedia $media)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:500'],
            'about_bio' => ['nullable', 'string'],
            'career_goal' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'linkedin' => ['nullable', 'url'],
            'github' => ['nullable', 'url'],
            'skills' => ['nullable', 'string'],
            'avatar' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,webp,bmp,heic,heif,jfif,avif', 'max:25600'],
        ]);

        $settings = PortfolioSetting::current();

        if ($request->hasFile('avatar')) {
            if ($settings->avatar_path) {
                $media->delete($settings->avatar_path);
            }
            $settings->avatar_path = $media->upload($request->file('avatar'), 'avatars');
        }

        $settings->skills = $this->parseSkills($request->input('skills'));
        $settings->fill(collect($data)->except(['skills', 'avatar'])->toArray());
        $settings->save();

        if (auth()->check()) {
            $user = auth()->user();
            $user->name = $data['name'];
            if (!empty($data['email'])) {
                $user->email = $data['email'];
            }
            $user->save();
        }

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Profil portofolio berhasil diperbarui.');
    }

    private function parseSkills(?string $skills): array
    {
        if (! $skills) {
            return [];
        }

        $parsed = [];
        foreach (explode("\n", $skills) as $line) {
            $line = trim($line);
            if (! $line) {
                continue;
            }

            $parts = array_map('trim', explode('|', $line));
            $parsed[] = [
                'name' => $parts[0] ?? '',
                'detail' => $parts[1] ?? '',
                'icon' => $parts[2] ?? 'chart',
            ];
        }

        return $parsed;
    }
}
