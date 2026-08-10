@extends('layouts.admin')

@section('title', 'Edit Profil')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900">Edit Profil Portofolio</h1>
        <p class="text-slate-500">Perbarui informasi yang ditampilkan di website publik</p>
    </div>

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="admin-card p-6 space-y-4 max-w-2xl">
            {{-- Foto Profil --}}
            <div class="flex items-center gap-4 pb-4 border-b border-slate-100">
                <div class="w-16 h-16 rounded-full bg-slate-100 border border-slate-200 overflow-hidden flex items-center justify-center flex-shrink-0">
                    @if($settings->avatar_path)
                        <img src="{{ asset('storage/' . $settings->avatar_path) }}" alt="{{ $settings->name }}" class="w-full h-full object-cover">
                    @else
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Foto Profil</label>
                    <input type="file" name="avatar" accept="image/*" data-crop-ratio="1"
                           class="text-sm text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 cursor-pointer">
                    <p class="text-xs text-slate-400 mt-1">JPEG, PNG, atau WebP max 2MB</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama *</label>
                <input type="text" name="name" value="{{ old('name', $settings->name) }}" required
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Jabatan / Title *</label>
                <input type="text" name="title" value="{{ old('title', $settings->title) }}" required
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tagline</label>
                <input type="text" name="tagline" value="{{ old('tagline', $settings->tagline) }}"
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">About Me</label>
                <textarea name="about_bio" rows="4"
                          class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">{{ old('about_bio', $settings->about_bio) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Career Goal</label>
                <textarea name="career_goal" rows="3"
                          class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">{{ old('career_goal', $settings->career_goal) }}</textarea>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $settings->email) }}"
                           class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">WhatsApp</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $settings->whatsapp) }}"
                           placeholder="+62 812-1315-0137"
                           class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">LinkedIn</label>
                    <input type="url" name="linkedin" value="{{ old('linkedin', $settings->linkedin) }}"
                           class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">GitHub</label>
                    <input type="url" name="github" value="{{ old('github', $settings->github) }}"
                           class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Skills</label>
                <p class="text-xs text-slate-500 mb-2">Satu skill per baris. Format: Nama | Detail | icon (python, database, table, chart, stats)</p>
                @php
                    $skillsText = old('skills');
                    if (! $skillsText) {
                        $skillsText = collect($settings->skills ?? [])
                            ->map(fn ($skill) => ($skill['name'] ?? '') . ' | ' . ($skill['detail'] ?? '') . ' | ' . ($skill['icon'] ?? 'chart'))
                            ->implode("\n");
                    }
                @endphp
                <textarea name="skills" rows="6"
                          class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none font-mono text-sm">{{ $skillsText }}</textarea>
            </div>
        </div>

        <button type="submit" class="mt-6 px-6 py-2 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700">Simpan Profil</button>
    </form>
@endsection
