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

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('certifications', 'public');
        } elseif ($request->filled('image_link')) {
            $data['image_url'] = $request->input('image_link');
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

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('certifications', 'public');
        } elseif ($request->filled('image_link')) {
            $data['image_url'] = $request->input('image_link');
        }

        $certification->update($data);

        $message = $data['is_published']
            ? 'Sertifikasi berhasil diperbarui.'
            : 'Draft sertifikasi berhasil disimpan.';

        return redirect()->route('admin.certifications.index')->with('success', $message);
    }

    public function destroy(Certification $certification)
    {
        $certification->delete();

        return redirect()->route('admin.certifications.index')
            ->with('success', 'Sertifikasi berhasil dihapus.');
    }

    private function validateCertification(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'issuer' => ['required', 'string', 'max:255'],
            'issue_date' => ['nullable', 'date'],
            'expiration_date' => ['nullable', 'date'],
            'credential_id' => ['nullable', 'string', 'max:255'],
            'credential_url' => ['nullable', 'url'],
            'image_link' => ['nullable', 'url'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);
    }
}
