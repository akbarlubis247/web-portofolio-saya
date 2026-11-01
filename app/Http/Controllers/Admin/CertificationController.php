<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    public function index()
    {
        $certifications = Certification::ordered()->get();

        return view('admin.certifications.index', compact('certifications'));
    }

    public function create()
    {
        return view('admin.certifications.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateCertification($request);
        $data['is_published'] = $request->input('action') !== 'draft';
        $data['credential_url'] = $this->normalizeUrl($request->input('credential_url'));

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('certifications', 'public');
        } elseif ($request->filled('image_link')) {
            $data['image_url'] = $this->normalizeUrl($request->input('image_link'));
        }

        Certification::create($data);

        $message = $data['is_published']
            ? 'Sertifikasi berhasil ditambahkan.'
            : 'Draft sertifikasi berhasil disimpan.';

        return redirect()->route('admin.certifications.index')->with('success', $message);
    }

    public function edit(Certification $certification)
    {
        return view('admin.certifications.edit', compact('certification'));
    }

    public function update(Request $request, Certification $certification)
    {
        $data = $this->validateCertification($request);
        $data['is_published'] = $request->input('action') !== 'draft';
        $data['credential_url'] = $this->normalizeUrl($request->input('credential_url'));

        if ($request->hasFile('image')) {
            $rawOld = $certification->getRawOriginal('image_url');
            if ($rawOld && ! str_starts_with($rawOld, 'http') && \Illuminate\Support\Facades\Storage::disk('public')->exists($rawOld)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($rawOld);
            }
            $data['image_url'] = $request->file('image')->store('certifications', 'public');
        } elseif ($request->filled('image_link')) {
            $data['image_url'] = $this->normalizeUrl($request->input('image_link'));
        }

        $certification->update($data);

        $message = $data['is_published']
            ? 'Sertifikasi berhasil diperbarui dan dipublikasikan.'
            : 'Draft sertifikasi berhasil disimpan.';

        return redirect()->route('admin.certifications.index')->with('success', $message);
    }

    public function togglePublish(Certification $certification)
    {
        $certification->is_published = ! $certification->is_published;
        $certification->save();

        $status = $certification->is_published ? 'dipublikasikan ke website publik' : 'disembunyikan (draft)';
        return back()->with('success', "Sertifikasi '{$certification->title}' berhasil {$status}.");
    }

    public function destroy(Certification $certification)
    {
        $raw = $certification->getRawOriginal('image_url');
        if ($raw && ! str_starts_with($raw, 'http') && \Illuminate\Support\Facades\Storage::disk('public')->exists($raw)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($raw);
        }

        $certification->delete();

        return redirect()->route('admin.certifications.index')
            ->with('success', 'Sertifikasi berhasil dihapus dari sistem dan website publik.');
    }

    private function validateCertification(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'issuer' => ['required', 'string', 'max:255'],
            'issue_date' => ['nullable', 'date'],
            'expiration_date' => ['nullable', 'date'],
            'credential_id' => ['nullable', 'string', 'max:255'],
            'credential_url' => ['nullable', 'string', 'max:500'],
            'image_link' => ['nullable', 'string', 'max:500'],
            'image' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,webp,bmp,heic,heif,jfif,avif', 'max:25600'],
        ]);
    }

    private function normalizeUrl(?string $url): ?string
    {
        if (! $url) {
            return null;
        }

        $url = trim($url);

        if (! str_starts_with($url, 'http://') && ! str_starts_with($url, 'https://')) {
            return 'https://'.$url;
        }

        return $url;
    }
}
