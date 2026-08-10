@extends('layouts.admin')

@section('title', 'Projects')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">📁 Projects</h1>
            <p class="text-slate-500">Total: <strong>{{ $projects->count() }}</strong> proyek</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="px-4 py-2 bg-cyan-600 text-white text-sm rounded-lg hover:bg-cyan-700 font-medium">
            ➕ Add Project
        </a>
    </div>

    <div class="admin-card overflow-hidden">
        @if($projects->count())
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr class="text-left text-slate-500">
                            <th class="px-6 py-3 font-medium">Title</th>
                            <th class="px-6 py-3 font-medium">Tools</th>
                            <th class="px-6 py-3 font-medium">Date</th>
                            <th class="px-6 py-3 font-medium">Status</th>
                            <th class="px-6 py-3 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                            <tr class="border-t border-slate-100 hover:bg-slate-50">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-slate-900">{{ $project->title }}</p>
                                    <p class="text-xs text-slate-500 truncate max-w-xs">{{ \Illuminate\Support\Str::limit($project->description, 70) }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(array_slice($project->tools ?? [], 0, 3) as $tool)
                                            <span class="text-xs px-2 py-0.5 bg-slate-100 rounded">{{ $tool }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-500">
                                    {{ $project->project_date?->format('d M Y') ?? $project->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($project->is_published)
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Published</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-amber-100 text-amber-700">Draft</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-3">
                                        <a href="{{ route('portfolio.project', $project) }}" target="_blank" class="text-slate-400 hover:text-cyan-600" title="Lihat">👁</a>
                                        <a href="{{ route('admin.projects.edit', $project) }}" class="text-cyan-600 hover:underline">✏️ Edit</a>
                                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Hapus proyek ini?')">
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
                <p class="text-slate-500 mb-4">Belum ada proyek.</p>
                <a href="{{ route('admin.projects.create') }}" class="text-cyan-600 hover:underline font-medium">➕ Tambah proyek pertama</a>
            </div>
        @endif
    </div>
@endsection
