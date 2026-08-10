@extends('layouts.admin')

@section('title', 'Edit Sertifikasi')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">✏️ Edit Sertifikasi</h1>
        <p class="text-slate-500">{{ $certification->title }}</p>
    </div>

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm space-y-1">
            <p class="font-bold">Terjadi kesalahan pada input:</p>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.certifications.update', $certification) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.certifications._form', ['certification' => $certification])

        <div class="flex flex-wrap gap-3 mt-6">
            <button type="submit" name="action" value="publish"
                    class="px-6 py-2.5 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700 font-medium">
                ✅ {{ $certification->is_published ? 'Perbarui & Publikasikan' : 'Publikasikan' }}
            </button>
            <button type="submit" name="action" value="draft"
                    class="px-6 py-2.5 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 font-medium">
                💾 Save Draft
            </button>
            <a href="{{ route('admin.certifications.index') }}" class="px-6 py-2.5 text-slate-500 hover:text-slate-700">Batal</a>
        </div>
    </form>
@endsection
