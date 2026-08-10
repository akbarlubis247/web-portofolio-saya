@extends('layouts.portfolio')

@section('title', $project->title . ' | ' . $settings->name)

@section('content')
    <section class="pt-16 pb-24 min-h-screen bg-gradient-to-b from-blue-50/20 via-transparent to-transparent">
        <div class="max-w-[800px] mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Back Button --}}
            <a href="{{ route('portfolio.index') }}#projects" class="inline-flex items-center gap-2 text-slate-500 hover:text-blue-600 mb-10 text-sm font-semibold transition-colors duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Projects
            </a>

            <div class="reveal mb-10">
                @if($project->project_date)
                    <p class="text-xs font-semibold text-blue-600 mb-3 uppercase tracking-wider">📅 {{ $project->project_date->format('d F Y') }}</p>
                @endif
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mb-4 tracking-tight leading-tight">{{ $project->title }}</h1>
                <p class="text-lg text-slate-600 leading-relaxed">{{ $project->description }}</p>

                @if($project->tools)
                    <div class="flex flex-wrap gap-2 mt-5">
                        @foreach($project->tools as $tool)
                            <span class="text-xs px-3 py-1.5 rounded-full bg-blue-50 text-blue-600 font-medium border border-blue-100/50">{{ $tool }}</span>
                        @endforeach
                    </div>
                @endif

                <div class="flex flex-wrap gap-4 mt-8">
                    @if($project->github_link)
                        <a href="{{ $project->github_link }}" target="_blank" rel="noopener" class="btn-primary px-6 py-3 rounded-xl text-white text-sm font-semibold flex items-center gap-2 shadow-lg shadow-blue-500/10">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.395-.135-.345-.72-1.395-1.23-1.895-.42-.405-1.02-.78-1.23-.99-.405-.33-.015-.33.015-.33.42 0 .855.195 1.23.57.405.405.54.54 1.32.54.78 0 1.335-.255 1.665-.78.45-.855 1.245-1.215 1.935-1.275.54-.045 1.05-.195 1.5-.405-.015-.39-.165-.78-.465-1.125C16.335 9.585 15.33 8.085 15.33 6.585c0-.585.21-1.14.555-1.605-.06-.135-.24-.69.06-1.44 0 0 .45-.15 1.485.57.435-.12.885-.18 1.335-.18.45 0 .9.06 1.335.18 1.035-.72 1.485-.57 1.485-.57.3.75.12 1.305.06 1.44.345.465.555 1.02.555 1.605 0 1.5-1.005 3-2.565 3.375-.3.345-.48.735-.48 1.125.39.015.78.09 1.125.24.69.285 1.335.885 1.335 1.905 0 1.365-.015 2.475-.015 2.82 0 .315.225.69.825.57A8.203 8.203 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                            Repository GitHub
                        </a>
                    @endif
                    @if($project->demo_link)
                        <a href="{{ $project->demo_link }}" target="_blank" rel="noopener" class="btn-outline px-6 py-3 rounded-xl text-blue-600 text-sm font-semibold flex items-center gap-2 border border-blue-500/20">
                            🌐 Lihat Live Demo
                        </a>
                    @endif
                </div>
            </div>

            @if($project->image_url)
                <div class="reveal mb-12 rounded-2xl overflow-hidden border border-slate-100 shadow-md">
                    <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full">
                </div>
            @endif

            <div class="space-y-10">
                @if($project->problem)
                    <div class="reveal case-study-section border-l-4 border-blue-500 pl-6 py-1">
                        <h2 class="text-xl font-bold text-slate-800 mb-3">🎯 Problem Statement</h2>
                        <div class="text-slate-600 leading-relaxed whitespace-pre-line text-sm sm:text-base">{{ $project->problem }}</div>
                    </div>
                @endif

                @if($project->insight)
                    <div class="reveal bg-emerald-500/5 border border-emerald-500/10 rounded-2xl p-6 sm:p-8">
                        <h2 class="text-xl font-bold text-emerald-700 mb-3 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-700 flex-shrink-0">
                                📊
                            </span>
                            Insight / Result
                        </h2>
                        <div class="text-slate-600 leading-relaxed whitespace-pre-line text-sm sm:text-base">{{ $project->insight }}</div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
