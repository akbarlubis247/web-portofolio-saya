@extends('layouts.admin')

@section('title', 'Projects')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">📁 Projects</h1>
            <p class="text-slate-500 text-sm mt-0.5">Total: <strong>{{ $projects->count() }}</strong> proyek di sistem &amp; website publik</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('portfolio.index') }}#projects" target="_blank" class="px-4 py-2 bg-slate-100 text-slate-700 text-sm rounded-lg hover:bg-slate-200 font-medium inline-flex items-center gap-1.5 border border-slate-200">
                🌐 Lihat di Website
            </a>
            <a href="{{ route('admin.projects.create') }}" class="px-4 py-2 bg-cyan-600 text-white text-sm rounded-lg hover:bg-cyan-700 font-medium inline-flex items-center gap-1.5 shadow-sm">
                ➕ Tambah Proyek
            </a>
        </div>
    </div>

    <div class="admin-card overflow-hidden">
        @if($projects->count())
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 border-b border-slate-200/80">
                        <tr class="text-left text-slate-600">
                            <th class="px-6 py-3.5 font-semibold">Proyek</th>
                            <th class="px-6 py-3.5 font-semibold">Tools</th>
                            <th class="px-6 py-3.5 font-semibold">Tanggal</th>
                            <th class="px-6 py-3.5 font-semibold">Status Publikasi</th>
                            <th class="px-6 py-3.5 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                            <tr class="border-t border-slate-100 hover:bg-slate-50/70 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-14 h-11 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden flex items-center justify-center flex-shrink-0 p-0.5">
                                            @if($project->image_url)
                                                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-full object-contain" onerror="this.onerror=null; this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">
                                                <div class="hidden w-full h-full flex items-center justify-center text-slate-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            @else
                                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 leading-snug">{{ $project->title }}</p>
                                            <p class="text-xs text-slate-500 truncate max-w-xs mt-0.5">{{ \Illuminate\Support\Str::limit($project->description, 65) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(array_slice($project->tools ?? [], 0, 3) as $tool)
                                            <span class="text-[11px] font-mono px-2 py-0.5 bg-slate-100 text-slate-700 rounded border border-slate-200">{{ $tool }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-600 font-mono text-xs">
                                    {{ $project->project_date?->format('d M Y') ?? $project->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.projects.toggle-publish', $project) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="cursor-pointer group" title="Klik untuk mengubah status publikasi">
                                            @if($project->is_published)
                                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-300 group-hover:bg-emerald-200 transition-colors inline-flex items-center gap-1.5">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                                    Tampil di Publik
                                                </span>
                                            @else
                                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800 border border-amber-300 group-hover:bg-amber-200 transition-colors inline-flex items-center gap-1.5">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                                    Draft (Disembunyikan)
                                                </span>
                                            @endif
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2.5">
                                        <a href="{{ route('portfolio.project', $project) }}" target="_blank" class="px-2 py-1 rounded bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium inline-flex items-center gap-1 transition-colors" title="Lihat Tampilan Publik">
                                            👁️ Cek
                                        </a>
                                        <a href="{{ route('admin.projects.edit', $project) }}" class="text-cyan-600 hover:text-cyan-800 text-xs font-medium">✏️ Edit</a>
                                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Hapus proyek ini dari admin dan website?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium cursor-pointer">❌ Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-16">
                <p class="text-slate-500 mb-4">Belum ada proyek.</p>
                <a href="{{ route('admin.projects.create') }}" class="text-cyan-600 hover:underline font-medium">➕ Tambah proyek pertama</a>
            </div>
        @endif
    </div>
@endsection
