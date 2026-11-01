@extends('layouts.admin')

@section('title', 'Sertifikasi')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">🎓 Sertifikasi</h1>
            <p class="text-slate-500 text-sm mt-0.5">Total: <strong>{{ $certifications->count() }}</strong> sertifikat di sistem &amp; website publik</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('portfolio.index') }}#certifications" target="_blank" class="px-4 py-2 bg-slate-100 text-slate-700 text-sm rounded-lg hover:bg-slate-200 font-medium inline-flex items-center gap-1.5 border border-slate-200">
                🌐 Lihat di Website
            </a>
            <a href="{{ route('admin.certifications.create') }}" class="px-4 py-2 bg-cyan-600 text-white text-sm rounded-lg hover:bg-cyan-700 font-medium inline-flex items-center gap-1.5 shadow-sm">
                ➕ Tambah Sertifikasi
            </a>
        </div>
    </div>

    <div class="admin-card overflow-hidden">
        @if($certifications->count())
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 border-b border-slate-200/80">
                        <tr class="text-left text-slate-600">
                            <th class="px-6 py-3.5 font-semibold">Sertifikat</th>
                            <th class="px-6 py-3.5 font-semibold">Penerbit</th>
                            <th class="px-6 py-3.5 font-semibold">Tanggal Terbit</th>
                            <th class="px-6 py-3.5 font-semibold">Status Publikasi</th>
                            <th class="px-6 py-3.5 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($certifications as $cert)
                            <tr class="border-t border-slate-100 hover:bg-slate-50/70 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-14 h-11 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden flex items-center justify-center flex-shrink-0 p-0.5">
                                            @if($cert->image_url)
                                                <img src="{{ $cert->image_url }}" alt="{{ $cert->title }}" class="w-full h-full object-contain" onerror="this.onerror=null; this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">
                                                <div class="hidden w-full h-full flex items-center justify-center text-slate-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                                    </svg>
                                                </div>
                                            @else
                                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 leading-snug">{{ $cert->title }}</p>
                                            @if($cert->credential_id)
                                                <p class="text-xs text-slate-500 font-mono mt-0.5 truncate max-w-xs">{{ $cert->credential_id }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-700 font-medium">
                                    {{ $cert->issuer }}
                                </td>
                                <td class="px-6 py-4 text-slate-600 font-mono text-xs">
                                    {{ $cert->issue_date?->format('d M Y') ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.certifications.toggle-publish', $cert) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="cursor-pointer group" title="Klik untuk mengubah status publikasi">
                                            @if($cert->is_published)
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
                                        @if($cert->credential_url)
                                            <a href="{{ $cert->credential_url }}" target="_blank" class="px-2 py-1 rounded bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium inline-flex items-center gap-1 transition-colors" title="Buka Link Kredensial">
                                                🌐 Link
                                            </a>
                                        @endif
                                        <a href="{{ route('admin.certifications.edit', $cert) }}" class="text-cyan-600 hover:text-cyan-800 text-xs font-medium">✏️ Edit</a>
                                        <form action="{{ route('admin.certifications.destroy', $cert) }}" method="POST" onsubmit="return confirm('Hapus sertifikasi ini dari admin dan website?')">
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
                <p class="text-slate-500 mb-4">Belum ada sertifikasi.</p>
                <a href="{{ route('admin.certifications.create') }}" class="text-cyan-600 hover:underline font-medium">➕ Tambah sertifikasi pertama</a>
            </div>
        @endif
    </div>
@endsection
