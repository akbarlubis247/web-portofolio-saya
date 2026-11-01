@extends('layouts.portfolio')

@section('title', $project->title . ' | ' . $settings->name)

@section('content')
    <section class="pt-24 pb-28 min-h-screen bg-[#F6F1E7] text-[#1D2A35]">
        <div class="max-w-[900px] mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Back Button --}}
            <a href="{{ route('portfolio.index') }}#projects" data-magnetic="true" class="inline-flex items-center gap-2 text-xs font-mono font-bold uppercase tracking-wider text-[#467C78] hover:text-[#1D2A35] mb-10 transition-colors duration-200 group">
                <span class="group-hover:-translate-x-1 transition-transform">&larr;</span>
                Kembali ke Projects
            </a>

            <div class="reveal mb-12">
                @if($project->project_date)
                    <div class="inline-flex items-center gap-2 mb-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#467C78]"></span>
                        <p class="font-mono text-xs font-bold text-[#467C78] uppercase tracking-widest">
                            {{ $project->project_date->format('d F Y') }}
                        </p>
                    </div>
                @endif

                <h1 class="text-3xl sm:text-5xl font-extrabold text-[#1D2A35] mb-5 tracking-tight leading-tight">
                    {{ $project->title }}
                </h1>

                <p class="text-base sm:text-lg text-[#1D2A35]/80 leading-relaxed font-light mb-6">
                    {{ $project->description }}
                </p>

                @if($project->tools)
                    <div class="flex flex-wrap gap-2 mt-4">
                        @foreach($project->tools as $tool)
                            <span class="editorial-tag">{{ $tool }}</span>
                        @endforeach
                    </div>
                @endif

                <div class="flex flex-wrap gap-4 mt-8 pt-6 border-t border-[#D7D8D1]">
                    @if($project->github_link)
                        <a href="{{ $project->github_link }}" target="_blank" rel="noopener" data-magnetic="true" class="btn-editorial-primary px-6 py-3.5 text-xs sm:text-sm font-bold tracking-wide">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.395-.135-.345-.72-1.395-1.23-1.895-.42-.405-1.02-.78-1.23-.99-.405-.33-.015-.33.015-.33.42 0 .855.195 1.23.57.405.405.54.54 1.32.54.78 0 1.335-.255 1.665-.78.45-.855 1.245-1.215 1.935-1.275.54-.045 1.05-.195 1.5-.405-.015-.39-.165-.78-.465-1.125C16.335 9.585 15.33 8.085 15.33 6.585c0-.585.21-1.14.555-1.605-.06-.135-.24-.69.06-1.44 0 0 .45-.15 1.485.57.435-.12.885-.18 1.335-.18.45 0 .9.06 1.335.18 1.035-.72 1.485-.57 1.485-.57.3.75.12 1.305.06 1.44.345.465.555 1.02.555 1.605 0 1.5-1.005 3-2.565 3.375-.3.345-.48.735-.48 1.125.39.015.78.09 1.125.24.69.285 1.335.885 1.335 1.905 0 1.365-.015 2.475-.015 2.82 0 .315.225.69.825.57A8.203 8.203 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                            Repository GitHub
                        </a>
                    @endif
                    @if($project->demo_link)
                        <a href="{{ $project->demo_link }}" target="_blank" rel="noopener" data-magnetic="true" class="btn-editorial-gold px-6 py-3.5 text-xs sm:text-sm font-bold tracking-wide">
                            🌐 Lihat Live Demo
                        </a>
                    @endif
                </div>
            </div>

            @if($project->image_url)
                <div class="reveal mb-14 editorial-card tilt-card rounded-3xl p-3 sm:p-4 border border-[#D7D8D1] shadow-lg">
                    <div class="rounded-2xl overflow-hidden bg-[#E8E4DA] flex flex-col items-center justify-center p-2 sm:p-4">
                        <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-auto max-h-[750px] object-contain rounded-xl mx-auto block shadow-xs" onerror="this.onerror=null; this.classList.add('hidden');">
                        <div class="w-full flex justify-end pt-3">
                            <a href="{{ $project->image_url }}" target="_blank" rel="noopener" class="text-xs font-mono text-[#467C78] hover:text-[#1D2A35] font-bold inline-flex items-center gap-1.5 transition-colors">
                                <span>🔍 Buka Bukti / Gambar Ukuran Penuh &rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <div class="space-y-10">
                @if($project->problem)
                    <div class="reveal editorial-card tilt-card rounded-2xl p-7 sm:p-8 border-l-4 border-l-[#467C78] shadow-xs">
                        <span class="font-mono text-xs uppercase tracking-widest text-[#467C78] font-bold block mb-2">[ 01. LATAR BELAKANG ]</span>
                        <h2 class="text-xl sm:text-2xl font-extrabold text-[#1D2A35] mb-4">🎯 Problem Statement</h2>
                        <div class="text-[#1D2A35]/80 leading-relaxed whitespace-pre-line text-sm sm:text-base font-light">{{ $project->problem }}</div>
                    </div>
                @endif

                @if($project->insight)
                    <div class="reveal editorial-card-dark tilt-card rounded-2xl p-7 sm:p-8 border border-[#D7D8D1]/15 shadow-xl text-[#F6F1E7]">
                        <span class="font-mono text-xs uppercase tracking-widest text-[#D5B98C] font-bold block mb-2">[ 02. HASIL ANALISIS ]</span>
                        <h2 class="text-xl sm:text-2xl font-extrabold text-[#F6F1E7] mb-4 flex items-center gap-2.5">
                            <span class="w-8 h-8 rounded-lg bg-[#D5B98C]/15 flex items-center justify-center text-[#D5B98C] flex-shrink-0 text-base">
                                📊
                            </span>
                            Insight / Result
                        </h2>
                        <div class="text-[#F6F1E7]/85 leading-relaxed whitespace-pre-line text-sm sm:text-base font-light">{{ $project->insight }}</div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
