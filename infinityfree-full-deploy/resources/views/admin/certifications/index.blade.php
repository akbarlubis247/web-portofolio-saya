@extends('layouts.admin')

@section('title', 'Sertifikasi')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">🎓 Sertifikasi</h1>
            <p class="text-slate-500">Total: <strong>{{ $certifications->count() }}</strong> sertifikat</p>
        </div>
        <a href="{{ route('admin.certifications.create') }}" class="px-4 py-2 bg-cyan-600 text-white text-sm rounded-lg hover:bg-cyan-700 font-medium">
            ➕ Add Certification
        </a>
    </div>

    <div class="admin-card overflow-hidden">
        @if($certifications->count())
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr class="text-left text-slate-500">
                            <th class="px-6 py-3 font-medium">Sertifikat</th>
                            <th class="px-6 py-3 font-medium">Penerbit</th>
                            <th class="px-6 py-3 font-medium">Tanggal Terbit</th>
                            <th class="px-6 py-3 font-medium">Status</th>
                            <th class="px-6 py-3 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($certifications as $cert)
                            <tr class="border-t border-slate-100 hover:bg-slate-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden flex items-center justify-center flex-shrink-0">
                                            @if($cert->image_url)
                                                <img src="{{ $cert->image_url }}" alt="{{ $cert->title }}" class="w-full h-full object-cover">
                                            @else
                                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-900">{{ $cert->title }}</p>
                                            @if($cert->credential_id)
                                                <p class="text-xs text-slate-500 font-mono">{{ $cert->credential_id }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-700">
                                    {{ $cert->issuer }}
                                </td>
                                <td class="px-6 py-4 text-slate-500">
                                    {{ $cert->issue_date?->format('d M Y') ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($cert->is_published)
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Published</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-amber-100 text-amber-700">Draft</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-3">
                                        @if($cert->credential_url)
                                            <a href="{{ $cert->credential_url }}" target="_blank" class="text-slate-400 hover:text-cyan-600" title="Kredensial">🌐</a>
                                        @endif
                                        <a href="{{ route('admin.certifications.edit', $cert) }}" class="text-cyan-600 hover:underline">✏️ Edit</a>
                                        <form action="{{ route('admin.certifications.destroy', $cert) }}" method="POST" onsubmit="return confirm('Hapus sertifikasi ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">❌ Delete</button>
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
