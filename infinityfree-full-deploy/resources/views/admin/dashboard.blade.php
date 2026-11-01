@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">📊 Dashboard Admin</h1>
            <p class="text-slate-500">Selamat datang kembali, <strong class="text-slate-800">{{ $settings->name ?: auth()->user()->name }}</strong>!</p>
        </div>
        <div class="flex flex-wrap gap-2.5">
            <a href="{{ route('portfolio.index') }}" target="_blank" class="px-4 py-2 border border-slate-300 text-slate-700 text-sm rounded-lg hover:bg-slate-50 flex items-center gap-1.5 font-medium">
                🌐 Lihat Website
            </a>
            <a href="{{ route('admin.projects.create') }}" class="px-4 py-2 bg-cyan-600 text-white text-sm rounded-lg hover:bg-cyan-700 flex items-center gap-1.5 font-medium shadow-xs">
                ➕ Tambah Proyek
            </a>
            <a href="{{ route('admin.certifications.create') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 flex items-center gap-1.5 font-medium shadow-xs">
                🎓 Tambah Sertifikasi
            </a>
        </div>
    </div>

    {{-- 4 Stat Cards --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        {{-- Total Proyek --}}
        <a href="{{ route('admin.projects.index') }}" class="admin-card p-5 hover:border-cyan-300 transition-all group block">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Proyek</span>
                <span class="p-2 rounded-lg bg-cyan-50 text-cyan-600 group-hover:bg-cyan-100 transition-colors">📁</span>
            </div>
            <p class="text-3xl font-extrabold text-slate-900 mt-2">{{ $projectCount }}</p>
            <p class="text-xs text-slate-500 mt-1">
                <span class="text-green-600 font-semibold">{{ $publishedCount }}</span> Dipublikasikan &bull; 
                <span class="text-amber-600 font-semibold">{{ $projectCount - $publishedCount }}</span> Draft
            </p>
        </a>

        {{-- Total Sertifikasi --}}
        <a href="{{ route('admin.certifications.index') }}" class="admin-card p-5 hover:border-blue-300 transition-all group block">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Sertifikasi</span>
                <span class="p-2 rounded-lg bg-blue-50 text-blue-600 group-hover:bg-blue-100 transition-colors">🎓</span>
            </div>
            <p class="text-3xl font-extrabold text-slate-900 mt-2">{{ $certificationCount }}</p>
            <p class="text-xs text-slate-500 mt-1">
                <span class="text-green-600 font-semibold">{{ $publishedCertCount }}</span> Dipublikasikan &bull; 
                <span class="text-amber-600 font-semibold">{{ $certificationCount - $publishedCertCount }}</span> Draft
            </p>
        </a>

        {{-- Profil Status --}}
        <a href="{{ route('admin.profile.edit') }}" class="admin-card p-5 hover:border-violet-300 transition-all group block">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Profil Portofolio</span>
                <span class="p-2 rounded-lg bg-violet-50 text-violet-600 group-hover:bg-violet-100 transition-colors">👤</span>
            </div>
            <p class="text-lg font-bold text-slate-900 mt-2 truncate">{{ $settings->name }}</p>
            <p class="text-xs text-slate-500 mt-0.5 truncate">{{ $settings->title }}</p>
        </a>

        {{-- Skills Terdaftar --}}
        <a href="{{ route('admin.profile.edit') }}" class="admin-card p-5 hover:border-emerald-300 transition-all group block">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Keahlian (Skills)</span>
                <span class="p-2 rounded-lg bg-emerald-50 text-emerald-600 group-hover:bg-emerald-100 transition-colors">⚡</span>
            </div>
            <p class="text-3xl font-extrabold text-slate-900 mt-2">{{ count($settings->skills ?? []) }}</p>
            <p class="text-xs text-emerald-600 font-medium mt-1">Skill aktif di portofolio</p>
        </a>
    </div>

    {{-- Main 2 Column Grid --}}
    <div class="grid lg:grid-cols-12 gap-8">
        {{-- Left column: Recent Projects & Recent Certifications --}}
        <div class="lg:col-span-8 space-y-8">
            {{-- Proyek Terbaru Card --}}
            <div class="admin-card p-6">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            📁 Proyek Terbaru
                        </h2>
                        <p class="text-xs text-slate-400">Daftar proyek yang ada di portofolio Anda</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.projects.index') }}" class="text-xs text-cyan-600 hover:underline font-medium">Lihat Semua</a>
                        <a href="{{ route('admin.projects.create') }}" class="px-3 py-1.5 bg-cyan-600 text-white text-xs rounded-lg hover:bg-cyan-700 font-medium">
                            + Tambah
                        </a>
                    </div>
                </div>

                @if($recentProjects->count())
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-slate-500 text-xs uppercase tracking-wider">
                                    <th class="pb-3 font-semibold">Proyek</th>
                                    <th class="pb-3 font-semibold">Tools</th>
                                    <th class="pb-3 font-semibold">Status</th>
                                    <th class="pb-3 font-semibold text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($recentProjects as $project)
                                    <tr class="hover:bg-slate-50/70 transition-colors">
                                        <td class="py-3">
                                            <div class="flex items-center gap-3">
                                                <div class="w-12 h-9 rounded-md bg-slate-100 border border-slate-200 overflow-hidden flex items-center justify-center flex-shrink-0">
                                                    @if($project->image_url)
                                                        <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                                                    @else
                                                        <span class="text-xs text-slate-400">No img</span>
                                                    @endif
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="font-medium text-slate-900 truncate max-w-[200px] sm:max-w-xs">{{ $project->title }}</p>
                                                    <p class="text-xs text-slate-400">{{ $project->project_date?->format('d M Y') ?? $project->created_at->format('d M Y') }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <div class="flex flex-wrap gap-1 max-w-[150px]">
                                                @foreach(array_slice($project->tools ?? [], 0, 2) as $tool)
                                                    <span class="text-[11px] px-1.5 py-0.5 bg-slate-100 text-slate-600 rounded">{{ $tool }}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            @if($project->is_published)
                                                <span class="px-2 py-0.5 text-xs rounded-full bg-green-100 text-green-700 font-medium">Published</span>
                                            @else
                                                <span class="px-2 py-0.5 text-xs rounded-full bg-slate-100 text-slate-600 font-medium">Draft</span>
                                            @endif
                                        </td>
                                        <td class="py-3 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('portfolio.project', $project) }}" target="_blank" class="text-slate-400 hover:text-cyan-600 text-xs" title="Lihat">👁</a>
                                                <a href="{{ route('admin.projects.edit', $project) }}" class="text-cyan-600 hover:underline font-medium text-xs">✏️ Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8 text-slate-400">
                        <p class="text-sm">Belum ada proyek.</p>
                        <a href="{{ route('admin.projects.create') }}" class="text-cyan-600 hover:underline text-xs mt-1 inline-block">+ Tambah proyek pertama</a>
                    </div>
                @endif
            </div>

            {{-- Sertifikasi Terbaru Card --}}
            <div class="admin-card p-6">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            🎓 Sertifikasi Terbaru
                        </h2>
                        <p class="text-xs text-slate-400">Sertifikat dan lisensi yang terdaftar di portofolio</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.certifications.index') }}" class="text-xs text-blue-600 hover:underline font-medium">Lihat Semua</a>
                        <a href="{{ route('admin.certifications.create') }}" class="px-3 py-1.5 bg-blue-600 text-white text-xs rounded-lg hover:bg-blue-700 font-medium">
                            + Tambah
                        </a>
                    </div>
                </div>

                @if($recentCertifications->count())
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-slate-500 text-xs uppercase tracking-wider">
                                    <th class="pb-3 font-semibold">Sertifikasi</th>
                                    <th class="pb-3 font-semibold">Penerbit</th>
                                    <th class="pb-3 font-semibold">Status</th>
                                    <th class="pb-3 font-semibold text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($recentCertifications as $cert)
                                    <tr class="hover:bg-slate-50/70 transition-colors">
                                        <td class="py-3">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-lg bg-blue-50 border border-blue-100/60 overflow-hidden flex items-center justify-center flex-shrink-0 text-blue-600">
                                                    @if($cert->image_url)
                                                        <img src="{{ $cert->image_url }}" alt="{{ $cert->title }}" class="w-full h-full object-contain p-1">
                                                    @else
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                                    @endif
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="font-medium text-slate-900 truncate max-w-[200px] sm:max-w-xs">{{ $cert->title }}</p>
                                                    <p class="text-xs text-slate-400">Terbit: {{ $cert->issue_date?->format('M Y') ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 text-slate-700 text-xs font-medium">
                                            {{ $cert->issuer }}
                                        </td>
                                        <td class="py-3">
                                            @if($cert->is_published)
                                                <span class="px-2 py-0.5 text-xs rounded-full bg-green-100 text-green-700 font-medium">Published</span>
                                            @else
                                                <span class="px-2 py-0.5 text-xs rounded-full bg-slate-100 text-slate-600 font-medium">Draft</span>
                                            @endif
                                        </td>
                                        <td class="py-3 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                @if($cert->credential_url)
                                                    <a href="{{ $cert->credential_url }}" target="_blank" class="text-slate-400 hover:text-blue-600 text-xs" title="Lihat Kredensial">🌐</a>
                                                @endif
                                                <a href="{{ route('admin.certifications.edit', $cert) }}" class="text-blue-600 hover:underline font-medium text-xs">✏️ Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8 text-slate-400">
                        <p class="text-sm">Belum ada sertifikasi.</p>
                        <a href="{{ route('admin.certifications.create') }}" class="text-blue-600 hover:underline text-xs mt-1 inline-block">+ Tambah sertifikasi pertama</a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Right column: Profile Summary Card --}}
        <div class="lg:col-span-4 space-y-6">
            <div class="admin-card p-6">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                    <h3 class="font-bold text-slate-900 flex items-center gap-2">
                        👤 Ringkasan Profil
                    </h3>
                    <a href="{{ route('admin.profile.edit') }}" class="text-xs text-cyan-600 hover:underline font-medium">
                        ✏️ Edit Profil
                    </a>
                </div>

                {{-- Avatar & Bio --}}
                <div class="flex flex-col items-center text-center pb-5 border-b border-slate-100">
                    <div class="w-20 h-20 rounded-full bg-slate-100 border-2 border-cyan-500/30 overflow-hidden mb-3 shadow-xs flex items-center justify-center">
                        @if($settings->avatar_path)
                            <img src="{{ asset('storage/' . $settings->avatar_path) }}" alt="{{ $settings->name }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        @endif
                    </div>
                    <h4 class="font-bold text-slate-900 text-base leading-snug">{{ $settings->name }}</h4>
                    <p class="text-xs font-semibold text-cyan-600 mt-0.5">{{ $settings->title }}</p>
                    @if($settings->tagline)
                        <p class="text-xs text-slate-500 mt-2 italic px-2">"{{ $settings->tagline }}"</p>
                    @endif
                </div>

                {{-- Contact Info --}}
                <div class="py-4 border-b border-slate-100 space-y-2 text-xs">
                    <div class="flex items-center justify-between text-slate-600">
                        <span class="text-slate-400 font-medium">📧 Email</span>
                        <span class="font-medium truncate max-w-[180px]">{{ $settings->email ?: '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between text-slate-600">
                        <span class="text-slate-400 font-medium">📱 WhatsApp</span>
                        <span class="font-medium">{{ $settings->whatsapp ?: '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between text-slate-600">
                        <span class="text-slate-400 font-medium">💼 LinkedIn</span>
                        <span>{{ $settings->linkedin ? 'Tersedia' : '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between text-slate-600">
                        <span class="text-slate-400 font-medium">🐙 GitHub</span>
                        <span>{{ $settings->github ? 'Tersedia' : '-' }}</span>
                    </div>
                </div>

                {{-- Skills Preview --}}
                <div class="pt-4">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Skills Terdaftar</p>
                    <div class="flex flex-wrap gap-1.5">
                        @forelse($settings->skills ?? [] as $skill)
                            <span class="text-xs px-2.5 py-1 rounded-md bg-cyan-50 text-cyan-700 font-medium border border-cyan-100">
                                {{ $skill['name'] }}
                            </span>
                        @empty
                            <p class="text-xs text-slate-400">Belum ada skill.</p>
                        @endforelse
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.profile.edit') }}" class="w-full block py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-center rounded-lg text-xs font-medium transition-colors">
                        ⚙️ Kelola Profil & Foto
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
