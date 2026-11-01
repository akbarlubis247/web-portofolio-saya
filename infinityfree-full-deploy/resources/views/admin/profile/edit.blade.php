@extends('layouts.admin')

@section('title', 'Edit Profil')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900">Edit Profil Portofolio</h1>
        <p class="text-slate-500">Perbarui informasi yang ditampilkan di website publik</p>
    </div>

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf @method('PUT')

        <div class="grid lg:grid-cols-12 gap-8 items-start">
            {{-- Form Inputs --}}
            <div class="lg:col-span-7 space-y-6">
                <div class="admin-card p-6 space-y-5">
                    <h3 class="font-semibold text-slate-900 pb-3 border-b border-slate-100 flex items-center gap-2">
                        <span>👤</span> Informasi Utama
                    </h3>

                    {{-- Foto Profil --}}
                    <div class="flex items-center gap-4 pb-4 border-b border-slate-100">
                        <div class="w-16 h-16 rounded-full bg-slate-100 border border-slate-200 overflow-hidden flex items-center justify-center flex-shrink-0">
                            @if($settings->avatar_path)
                                <img id="profile-avatar-img" src="{{ asset('storage/' . $settings->avatar_path) }}" alt="{{ $settings->name }}" class="w-full h-full object-cover" onerror="this.onerror=null; this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">
                                <svg class="hidden w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            @else
                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Foto Profil</label>
                            <input type="file" name="avatar" id="field-avatar" accept="image/*"
                                   class="text-sm text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 cursor-pointer">
                            <p class="text-xs text-slate-400 mt-1">Mendukung semua format foto (JPG, PNG, WebP) max 25MB.</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nama *</label>
                        <input type="text" name="name" id="field-name" value="{{ old('name', $settings->name) }}" required
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Jabatan / Title *</label>
                        <input type="text" name="title" id="field-title" value="{{ old('title', $settings->title) }}" required
                               placeholder="Contoh: Data Analyst"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tagline</label>
                        <input type="text" name="tagline" id="field-tagline" value="{{ old('tagline', $settings->tagline) }}"
                               placeholder="Contoh: Passionate about data, insights, and visualization"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">About Me</label>
                        <textarea name="about_bio" id="field-bio" rows="4"
                                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">{{ old('about_bio', $settings->about_bio) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Career Goal</label>
                        <textarea name="career_goal" rows="3"
                                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">{{ old('career_goal', $settings->career_goal) }}</textarea>
                    </div>
                </div>

                <div class="admin-card p-6 space-y-4">
                    <h3 class="font-semibold text-slate-900 pb-3 border-b border-slate-100 flex items-center gap-2">
                        <span>📱</span> Kontak & Media Sosial
                    </h3>
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
                </div>

                <div class="admin-card p-6 space-y-4">
                    <h3 class="font-semibold text-slate-900 pb-3 border-b border-slate-100 flex items-center gap-2">
                        <span>⚡</span> Keahlian (Skills)
                    </h3>
                    <p class="text-xs text-slate-500">Satu skill per baris. Format: Nama | Detail | icon (python, database, table, chart, stats, code)</p>
                    @php
                        $skillsText = (isset($errors) && $errors->any()) ? old('skills') : null;
                        if ($skillsText === null) {
                            $skillsText = collect($settings->skills ?? [])
                                ->map(fn ($skill) => ($skill['name'] ?? '') . ' | ' . ($skill['detail'] ?? '') . ' | ' . ($skill['icon'] ?? 'chart'))
                                ->implode("\n");
                        }
                    @endphp
                    <textarea name="skills" rows="6" autocomplete="off"
                              class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none font-mono text-sm">{{ $skillsText }}</textarea>
                </div>

                <div>
                    <button type="submit" class="px-8 py-3 bg-cyan-600 hover:bg-cyan-700 text-white font-medium rounded-lg shadow-sm transition">
                        💾 Simpan Perubahan Profil
                    </button>
                </div>
            </div>

            {{-- Live Preview Side Panel (Matching Homepage Hero Style) --}}
            <div class="lg:col-span-5 lg:sticky lg:top-6 space-y-4">
                <div class="admin-card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-slate-900">👁️ Live Preview Hero</h3>
                        <span class="text-[11px] font-mono uppercase tracking-wider text-[#467C78] font-bold">Homepage Style</span>
                    </div>

                    {{-- Exact Hero Snippet replica --}}
                    <div class="bg-[#F6F1E7] rounded-2xl p-6 border border-[#D7D8D1] shadow-inner text-left relative overflow-hidden">
                        {{-- Background dots pattern --}}
                        <div class="absolute inset-0 pointer-events-none opacity-40" style="background-image: radial-gradient(rgba(29, 42, 53, 0.08) 1px, transparent 1px); background-size: 20px 20px;"></div>

                        <div class="relative z-10">
                            {{-- Profile Avatar Card --}}
                            <div class="flex justify-center mb-6">
                                <div class="relative w-40 max-w-full">
                                    <div class="absolute -inset-1 rounded-2xl bg-[#D5B98C]/30 rotate-2 border border-[#D5B98C]/60"></div>
                                    <div class="relative bg-white rounded-2xl p-2 border border-[#D7D8D1] shadow-md">
                                        <div class="w-full aspect-[4/4.8] rounded-xl overflow-hidden bg-[#E8E4DA] flex items-center justify-center">
                                            @if($settings->avatar_path)
                                                <img id="preview-avatar-img" src="{{ asset('storage/' . $settings->avatar_path) }}" alt="" class="w-full h-full object-cover">
                                            @else
                                                <div id="preview-avatar-img" class="w-full h-full bg-[#1D2A35] flex items-center justify-center text-white font-bold text-2xl">
                                                    {{ strtoupper(substr($settings->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-sm font-extrabold text-[#1D2A35] tracking-tight mb-1">
                                Halo, Saya <br>
                                <span id="preview-name" class="font-serif-italic font-normal text-xl sm:text-2xl text-[#467C78]">{{ $settings->name }}</span>
                            </p>

                            <div class="flex items-center gap-2 text-sm text-[#1D2A35] font-semibold my-2 tracking-tight">
                                <span class="text-[#D5B98C] font-mono">&mdash;</span>
                                <h4 id="preview-title" class="truncate">{{ $settings->title }}</h4>
                            </div>

                            <p id="preview-tagline" class="text-xs text-[#1D2A35]/75 leading-relaxed my-3 font-normal">
                                {{ $settings->tagline ?? 'Passionate about data, insights, and visualization' }}
                            </p>

                            <div class="flex items-center gap-2 pt-3 border-t border-[#D7D8D1]/80">
                                <span class="text-[11px] font-bold px-3 py-1.5 rounded-lg bg-[#1D2A35] text-[#F6F1E7]">Lihat Proyek &rarr;</span>
                                <span class="text-[11px] font-bold px-3 py-1.5 rounded-lg border border-[#1D2A35] text-[#1D2A35]">Hubungi Saya</span>
                            </div>
                        </div>
                    </div>

                    <p class="text-xs text-slate-400 mt-3 text-center">Preview tersinkronisasi otomatis saat Anda mengetik</p>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fieldName = document.getElementById('field-name');
            const fieldTitle = document.getElementById('field-title');
            const fieldTagline = document.getElementById('field-tagline');

            const previewName = document.getElementById('preview-name');
            const previewTitle = document.getElementById('preview-title');
            const previewTagline = document.getElementById('preview-tagline');

            if (fieldName && previewName) {
                fieldName.addEventListener('input', () => {
                    previewName.textContent = fieldName.value || 'Nama Anda';
                });
            }

            if (fieldTitle && previewTitle) {
                fieldTitle.addEventListener('input', () => {
                    previewTitle.textContent = fieldTitle.value || 'Data Analyst';
                });
            }

            if (fieldTagline && previewTagline) {
                fieldTagline.addEventListener('input', () => {
                    previewTagline.textContent = fieldTagline.value || 'Passionate about data, insights, and visualization';
                });
            }
        });
    </script>
@endsection
