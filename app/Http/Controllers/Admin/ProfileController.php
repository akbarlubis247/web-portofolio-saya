<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioSetting;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $settings = PortfolioSetting::current();

        return view('admin.profile.edit', compact('settings'));
    }

    public function update(Request $request)
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
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        $settings = PortfolioSetting::current();

        if ($request->hasFile('avatar')) {
            if ($settings->avatar_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($settings->avatar_path);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $settings->avatar_path = $path;
        }

        $settings->skills = $this->parseSkills($request->input('skills'));
        $settings->fill(collect($data)->except(['skills', 'avatar'])->toArray());
        $settings->save();

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
