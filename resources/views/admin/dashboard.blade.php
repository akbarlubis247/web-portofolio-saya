@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900">Dashboard</h1>
        <p class="text-slate-500">Selamat datang, {{ auth()->user()->name }}!</p>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="admin-card p-6">
            <p class="text-sm text-slate-500">Total Proyek</p>
            <p class="text-3xl font-bold text-slate-900 mt-1">{{ $projectCount }}</p>
        </div>
        <div class="admin-card p-6">
            <p class="text-sm text-slate-500">Dipublikasikan</p>
            <p class="text-3xl font-bold text-cyan-600 mt-1">{{ $publishedCount }}</p>
        </div>
        <div class="admin-card p-6">
            <p class="text-sm text-slate-500">Nama Portofolio</p>
            <p class="text-lg font-semibold text-slate-900 mt-1">{{ $settings->name }}</p>
        </div>
    </div>

    <div class="admin-card p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-slate-900">Proyek Terbaru</h2>
            <a href="{{ route('admin.projects.create') }}" class="px-4 py-2 bg-cyan-600 text-white text-sm rounded-lg hover:bg-cyan-700">
                + Tambah Proyek
            </a>
        </div>

        @if($recentProjects->count())
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 text-left text-slate-500">
                            <th class="pb-3 font-medium">Judul</th>
                            <th class="pb-3 font-medium">Status</th>
                            <th class="pb-3 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentProjects as $project)
                            <tr class="border-b border-slate-100">
                                <td class="py-3 text-slate-900">{{ $project->title }}</td>
                                <td class="py-3">
                                    @if($project->is_published)
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Published</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-slate-100 text-slate-600">Draft</span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="text-cyan-600 hover:underline">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-slate-500 text-center py-8">Belum ada proyek. <a href="{{ route('admin.projects.create') }}" class="text-cyan-600 hover:underline">Tambah sekarang</a></p>
        @endif
    </div>
@endsection
