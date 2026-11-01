@extends('layouts.admin')

@section('title', 'Tambah Sertifikasi')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">➕ Tambah Sertifikasi Baru</h1>
        <p class="text-slate-500">Isi form di bawah — preview tampil di kanan.</p>
    </div>

    @if(isset($errors) && $errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm space-y-1">
            <p class="font-bold">Terjadi kesalahan pada input:</p>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.certifications.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.certifications._form')

        <div class="flex flex-wrap gap-3 mt-6">
            <button type="submit" name="action" value="publish"
                    class="px-6 py-2.5 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700 font-semibold shadow-sm">
                ✅ Simpan &amp; Publikasikan (Tampil di Website)
            </button>
            <button type="submit" name="action" value="draft"
                    class="px-6 py-2.5 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 font-medium">
                💾 Simpan sebagai Draft (Disembunyikan)
            </button>
            <a href="{{ route('admin.certifications.index') }}" class="px-6 py-2.5 text-slate-500 hover:text-slate-700">Batal</a>
        </div>
    </form>
@endsection
