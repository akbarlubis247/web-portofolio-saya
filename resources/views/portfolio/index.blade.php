@extends('layouts.portfolio')

@section('content')
    {{-- Hero Section (Cream Canvas, Sharlee Editorial Style) --}}
    <section id="home" class="relative min-h-[90vh] flex items-center pt-24 pb-20 overflow-hidden bg-[#F6F1E7]">
        {{-- Subtle architectural background grid / accent lines --}}
        <div class="absolute inset-0 pointer-events-none opacity-40">
            <div class="h-full w-full" style="background-image: radial-gradient(rgba(29, 42, 53, 0.08) 1px, transparent 1px); background-size: 32px 32px;"></div>
        </div>

        <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8 py-10 relative w-full">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                {{-- Hero Left: Expressive Editorial Typography --}}
                <div class="lg:col-span-7 reveal text-left">
                    <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold leading-[1.06] text-[#1D2A35] tracking-tight mb-5">
                        Halo, Saya <br>
                        <span class="font-serif-italic font-normal text-[#467C78]">{{ $settings->name }}</span>
                    </h1>

                    <div class="flex items-center gap-3 text-lg sm:text-2xl text-[#1D2A35] font-semibold mb-6 tracking-tight">
                        <span class="text-[#D5B98C] font-mono text-base sm:text-xl">&mdash;</span>
                        <h2>{{ $settings->title }}</h2>
                    </div>

                    <p class="text-base sm:text-lg text-[#1D2A35]/75 leading-relaxed mb-10 max-w-xl font-normal">
                        {{ $settings->tagline ?? 'Passionate about data, insights, and visualization' }}
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="#projects" data-magnetic="true" class="btn-editorial-primary px-8 py-4 text-sm font-bold tracking-wide">
                            Lihat Proyek
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="#contact" data-magnetic="true" class="btn-editorial-secondary px-8 py-4 text-sm font-bold tracking-wide">
                            Hubungi Saya
                        </a>
                    </div>
                </div>

                {{-- Hero Right: Editorial Profile Visual & Metrics Stamp --}}
                <div class="lg:col-span-5 reveal reveal-delay-2 flex justify-center lg:justify-end">
                    <div class="relative w-full max-w-[380px]">
                        {{-- Offset decorative background frame with Gold touch --}}
                        <div class="absolute -inset-2 rounded-3xl bg-[#D5B98C]/30 rotate-2 border border-[#D5B98C]/60 transition-transform duration-500"></div>

                        {{-- Main visual container --}}
                        <div class="relative bg-white rounded-3xl p-3 border border-[#D7D8D1] shadow-xl tilt-card">
                            <div class="w-full aspect-[4/4.8] rounded-2xl overflow-hidden relative group bg-[#E8E4DA]">
                                @if($settings->avatar_url)
                                    <img src="{{ $settings->avatar_url }}" alt="{{ $settings->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" onerror="this.onerror=null; this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">
                                    <div class="hidden w-full h-full bg-[#1D2A35] flex flex-col items-center justify-center text-center p-6 text-[#F6F1E7]">
                                        <div class="w-20 h-20 rounded-2xl bg-[#D5B98C] text-[#1D2A35] flex items-center justify-center mb-4 font-bold text-3xl">
                                            {{ strtoupper(substr($settings->name, 0, 1)) }}
                                        </div>
                                        <span class="text-xl font-bold text-[#F6F1E7] tracking-tight">{{ $settings->name }}</span>
                                        <span class="text-xs text-[#D5B98C] mt-1 font-mono uppercase tracking-wider">{{ $settings->title }}</span>
                                    </div>
                                @else
                                    <div class="w-full h-full bg-[#1D2A35] flex flex-col items-center justify-center text-center p-6 text-[#F6F1E7]">
                                        <div class="w-20 h-20 rounded-2xl bg-[#D5B98C] text-[#1D2A35] flex items-center justify-center mb-4 font-bold text-3xl">
                                            {{ strtoupper(substr($settings->name, 0, 1)) }}
                                        </div>
                                        <span class="text-xl font-bold text-[#F6F1E7] tracking-tight">{{ $settings->name }}</span>
                                        <span class="text-xs text-[#D5B98C] mt-1 font-mono uppercase tracking-wider">{{ $settings->title }}</span>
                                    </div>
                                @endif

                                {{-- Dark subtle overlay with badge on hover --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-[#1D2A35]/60 via-transparent to-transparent opacity-80 pointer-events-none"></div>
                                <div class="absolute bottom-4 left-4 right-4 text-white text-xs font-mono flex items-center justify-between">
                                    <span class="bg-[#1D2A35]/80 px-2.5 py-1 rounded-md backdrop-blur-xs border border-white/10">PORTFOLIO</span>
                                    <span class="text-[#D5B98C]">&bull; {{ date('Y') }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Floating Project Metric Stamp --}}
                        <div class="absolute -left-6 -bottom-6 bg-[#1D2A35] text-[#F6F1E7] p-4 sm:p-5 rounded-2xl shadow-2xl border border-[#D5B98C]/40 flex items-center gap-3.5">
                            <div class="w-11 h-11 rounded-xl bg-[#467C78] flex items-center justify-center text-[#F6F1E7] flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-[10px] font-mono uppercase tracking-widest text-[#D5B98C]">Total Proyek</div>
                                <div class="text-sm sm:text-base font-bold text-[#F6F1E7] font-mono mt-0.5">{{ $projects->count() }}+ Proyek Data</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- About Section (Dark Contrast Section: Deep Navy #1D2A35) --}}
    <section id="about" class="py-28 bg-[#1D2A35] text-[#F6F1E7] relative overflow-hidden">
        {{-- Background decorative subtle pattern --}}
        <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="reveal mb-16">
                <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-[#F6F1E7]">
                    About <span class="font-serif-italic font-normal text-[#D5B98C]">Me</span>
                </h2>
                <div class="w-16 h-0.5 bg-[#467C78] mt-4"></div>
            </div>

            <div class="grid lg:grid-cols-12 gap-12 lg:gap-14 items-center">
                {{-- Left: Data Analytics Activity Card --}}
                <div class="lg:col-span-5 reveal flex justify-center">
                    <div class="editorial-card-dark tilt-card rounded-3xl p-7 w-full max-w-[420px] relative shadow-2xl">
                        {{-- Window Controls --}}
                        <div class="flex items-center justify-between pb-4 border-b border-[#D7D8D1]/10 mb-6">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#D5B98C]"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-[#467C78]"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-[#D7D8D1]/40"></span>
                            </div>
                            <span class="text-[10px] font-mono uppercase tracking-widest text-[#D7D8D1]/60">insights.dashboard</span>
                        </div>

                        {{-- Bar chart graphic with Cream & Gold --}}
                        <div class="bg-[#121A21] rounded-2xl p-6 border border-[#D7D8D1]/10 mb-5">
                            <div class="flex items-end gap-2.5 h-32 mb-4">
                                @foreach([35, 60, 40, 80, 55, 95, 75] as $h)
                                    <div class="flex-1 rounded-t-md transition-all duration-300 hover:opacity-100 group relative" style="height: {{ $h }}%; background: linear-gradient(to top, #467C78, #D5B98C);">
                                        <div class="opacity-0 group-hover:opacity-100 absolute -top-7 left-1/2 -translate-x-1/2 bg-[#1D2A35] border border-[#D5B98C] text-[10px] font-mono px-1 rounded text-[#D5B98C] transition-opacity">
                                            {{ $h }}%
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <p class="text-[11px] font-mono uppercase tracking-widest text-[#D5B98C] text-center font-bold">
                                Data Analytics Activity
                            </p>
                        </div>

                        {{-- Tag Banner --}}
                        <div class="text-center bg-[#467C78]/15 border border-[#467C78]/30 rounded-xl py-3.5 px-4">
                            <span class="text-xs font-mono font-semibold text-[#D5B98C] uppercase tracking-wide">
                                Turning Data into Actionable Insights
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Right: Text Details & Career Goal --}}
                <div class="lg:col-span-7 reveal reveal-delay-1">
                    <p class="text-[#F6F1E7]/85 leading-relaxed mb-8 text-base sm:text-lg font-light">
                        {{ $settings->about_bio }}
                    </p>
                    
                    @if($settings->career_goal)
                        <div class="editorial-card-dark rounded-2xl p-7 border-l-4 border-l-[#D5B98C] relative">
                            <h3 class="text-[#D5B98C] font-bold text-lg mb-3 flex items-center gap-2.5 tracking-tight">
                                <span class="w-8 h-8 rounded-lg bg-[#D5B98C]/15 text-[#D5B98C] flex items-center justify-center flex-shrink-0 font-bold">
                                    🎯
                                </span>
                                Career Goal
                            </h3>
                            <p class="text-[#F6F1E7]/80 leading-relaxed text-sm sm:text-base font-light">
                                {{ $settings->career_goal }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Projects Section (Cream Canvas, Editorial Showcase Layout) --}}
    <section id="projects" class="py-28 bg-[#F6F1E7]">
        <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="reveal mb-16 flex flex-col md:flex-row md:items-end justify-between gap-6 pb-6 border-b border-[#D7D8D1]">
                <div>
                    <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-[#1D2A35]">
                        Featured <span class="font-serif-italic font-normal text-[#467C78]">Projects</span>
                    </h2>
                </div>
                <p class="text-[#1D2A35]/70 max-w-md text-sm sm:text-base font-normal">
                    Kumpulan proyek analisis data yang menunjukkan kemampuan saya dalam mengolah data menjadi insight yang berguna.
                </p>
            </div>

            {{-- Asymmetrical Editorial Project Grid --}}
            <div class="space-y-12">
                @forelse($projects as $index => $project)
                    @php
                        $isLead = $index === 0;
                        $formattedIndex = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                    @endphp

                    @if($isLead)
                        {{-- Lead / Primary Featured Project in Expansive Horizontal Editorial Layout --}}
                        <article class="editorial-card tilt-card rounded-3xl overflow-hidden p-6 sm:p-8 reveal shadow-sm hover:border-[#467C78]">
                            <div class="grid lg:grid-cols-12 gap-8 items-center">
                                {{-- Project Image --}}
                                <div class="lg:col-span-7 aspect-[16/10] overflow-hidden rounded-2xl relative group bg-[#18232C] border border-[#D7D8D1]/80 flex items-center justify-center p-2">
                                    @if($project->image_url)
                                        <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-105" onerror="this.onerror=null; this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">
                                        <div class="hidden w-full h-full bg-[#1D2A35] p-8 flex flex-col justify-between text-white relative">
                                            <span class="text-xs font-mono uppercase tracking-widest text-[#D5B98C]">[ DATA ANALYTICS ]</span>
                                            <div>
                                                <h4 class="font-bold text-xl">{{ $project->title }}</h4>
                                                <p class="text-xs text-[#D7D8D1] mt-1 font-mono">Interactive Analytics Visualization</p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="w-full h-full bg-[#1D2A35] p-8 flex flex-col justify-between text-white relative">
                                            <span class="text-xs font-mono uppercase tracking-widest text-[#D5B98C]">[ DATA ANALYTICS ]</span>
                                            <div>
                                                <h4 class="font-bold text-xl">{{ $project->title }}</h4>
                                                <p class="text-xs text-[#D7D8D1] mt-1 font-mono">Interactive Analytics Visualization</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-[#1D2A35] text-[#D5B98C] text-xs font-mono font-bold px-3 py-1.5 rounded-full border border-[#D5B98C]/40">
                                            FEATURED #{{ $formattedIndex }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Project Details --}}
                                <div class="lg:col-span-5 flex flex-col justify-between h-full">
                                    <div>
                                        <div class="flex items-center justify-between gap-4 mb-3">
                                            <span class="font-mono text-xs text-[#467C78] font-bold uppercase tracking-widest">
                                                [ PROJECT {{ $formattedIndex }} ]
                                            </span>
                                            @if($project->project_date)
                                                <span class="font-mono text-xs text-[#1D2A35]/60">
                                                    {{ $project->project_date->format('M Y') }}
                                                </span>
                                            @endif
                                        </div>

                                        <h3 class="text-2xl sm:text-3xl font-extrabold text-[#1D2A35] mb-4 hover:text-[#467C78] transition-colors leading-tight">
                                            <a href="{{ route('portfolio.project', $project) }}">{{ $project->title }}</a>
                                        </h3>

                                        <p class="text-[#1D2A35]/75 text-sm sm:text-base leading-relaxed mb-6">
                                            {{ \Illuminate\Support\Str::limit($project->description, 160) }}
                                        </p>

                                        {{-- Tools Tags --}}
                                        @if($project->tools)
                                            <div class="flex flex-wrap gap-2 mb-8">
                                                @foreach($project->tools as $tool)
                                                    <span class="editorial-tag">{{ $tool }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Actions --}}
                                    <div class="flex items-center justify-between pt-6 border-t border-[#D7D8D1]">
                                        <a href="{{ route('portfolio.project', $project) }}" class="btn-editorial-primary px-6 py-3 text-xs sm:text-sm font-bold tracking-wide">
                                            Lihat Proyek &rarr;
                                        </a>
                                        @if($project->github_link)
                                            <a href="{{ $project->github_link }}" target="_blank" rel="noopener" class="p-2.5 rounded-xl border border-[#D7D8D1] text-[#1D2A35] hover:text-[#467C78] hover:border-[#467C78] transition-colors" title="GitHub Repository">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.395-.135-.345-.72-1.395-1.23-1.895-.42-.405-1.02-.78-1.23-.99-.405-.33-.015-.33.015-.33.42 0 .855.195 1.23.57.405.405.54.54 1.32.54.78 0 1.335-.255 1.665-.78.45-.855 1.245-1.215 1.935-1.275.54-.045 1.05-.195 1.5-.405-.015-.39-.165-.78-.465-1.125C16.335 9.585 15.33 8.085 15.33 6.585c0-.585.21-1.14.555-1.605-.06-.135-.24-.69.06-1.44 0 0 .45-.15 1.485.57.435-.12.885-.18 1.335-.18.45 0 .9.06 1.335.18 1.035-.72 1.485-.57 1.485-.57.3.75.12 1.305.06 1.44.345.465.555 1.02.555 1.605 0 1.5-1.005 3-2.565 3.375-.3.345-.48.735-.48 1.125.39.015.78.09 1.125.24.69.285 1.335.885 1.335 1.905 0 1.365-.015 2.475-.015 2.82 0 .315.225.69.825.57A8.203 8.203 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endif
                @empty
                    <div class="col-span-full text-center py-16 text-[#1D2A35]/50 font-mono">
                        Belum ada proyek. Login ke admin untuk menambahkan.
                    </div>
                @endforelse

                {{-- Secondary Projects Grid (2-column layout for remaining projects) --}}
                @if($projects->count() > 1)
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 pt-4">
                        @foreach($projects->slice(1) as $index => $project)
                            @php
                                $formattedIndex = str_pad($index + 2, 2, '0', STR_PAD_LEFT);
                            @endphp
                            <article class="editorial-card tilt-card rounded-2xl overflow-hidden flex flex-col reveal reveal-delay-{{ ($index % 3) + 1 }} shadow-xs">
                                {{-- Thumbnail --}}
                                <div class="aspect-video overflow-hidden relative group bg-[#18232C] border-b border-[#D7D8D1]/80 flex items-center justify-center p-2">
                                    @if($project->image_url)
                                        <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-105" onerror="this.onerror=null; this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">
                                        <div class="hidden w-full h-full bg-[#1D2A35] p-6 flex flex-col justify-between text-white relative">
                                            <span class="text-xs font-mono uppercase tracking-widest text-[#D5B98C]">[ DATA ANALYTICS ]</span>
                                            <div>
                                                <h4 class="font-bold text-base">{{ $project->title }}</h4>
                                                <p class="text-xs text-[#D7D8D1] mt-1 font-mono">Interactive Analytics Visualization</p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="w-full h-full bg-[#1D2A35] p-6 flex flex-col justify-between text-white relative">
                                            <span class="text-xs font-mono uppercase tracking-widest text-[#D5B98C]">[ DATA ANALYTICS ]</span>
                                            <div>
                                                <h4 class="font-bold text-base">{{ $project->title }}</h4>
                                                <p class="text-xs text-[#D7D8D1] mt-1 font-mono">Interactive Analytics Visualization</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-[#1D2A35]/90 text-[#F6F1E7] text-[10px] font-mono px-2.5 py-1 rounded-md backdrop-blur-xs">
                                            #{{ $formattedIndex }}
                                        </span>
                                    </div>
                                </div>

                                <div class="p-6 flex flex-col flex-1">
                                    @if($project->project_date)
                                        <p class="font-mono text-xs text-[#467C78] font-bold mb-2 uppercase tracking-widest">{{ $project->project_date->format('M Y') }}</p>
                                    @endif

                                    <h3 class="text-lg font-bold text-[#1D2A35] mb-2 hover:text-[#467C78] transition-colors leading-snug">
                                        <a href="{{ route('portfolio.project', $project) }}">{{ $project->title }}</a>
                                    </h3>

                                    <p class="text-[#1D2A35]/70 text-sm mb-5 leading-relaxed flex-1">
                                        {{ \Illuminate\Support\Str::limit($project->description, 110) }}
                                    </p>

                                    @if($project->tools)
                                        <div class="flex flex-wrap gap-1.5 mb-6">
                                            @foreach($project->tools as $tool)
                                                <span class="editorial-tag text-[10px] py-0.5 px-2">{{ $tool }}</span>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="flex items-center justify-between pt-4 border-t border-[#D7D8D1] mt-auto">
                                        <a href="{{ route('portfolio.project', $project) }}" class="text-xs font-mono font-bold text-[#1D2A35] hover:text-[#467C78] flex items-center gap-1.5 transition-colors uppercase tracking-wider">
                                            Lihat Proyek &rarr;
                                        </a>
                                        @if($project->github_link)
                                            <a href="{{ $project->github_link }}" target="_blank" rel="noopener" class="text-[#1D2A35]/50 hover:text-[#467C78] transition-colors" title="GitHub Repository">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.395-.135-.345-.72-1.395-1.23-1.895-.42-.405-1.02-.78-1.23-.99-.405-.33-.015-.33.015-.33.42 0 .855.195 1.23.57.405.405.54.54 1.32.54.78 0 1.335-.255 1.665-.78.45-.855 1.245-1.215 1.935-1.275.54-.045 1.05-.195 1.5-.405-.015-.39-.165-.78-.465-1.125C16.335 9.585 15.33 8.085 15.33 6.585c0-.585.21-1.14.555-1.605-.06-.135-.24-.69.06-1.44 0 0 .45-.15 1.485.57.435-.12.885-.18 1.335-.18.45 0 .9.06 1.335.18 1.035-.72 1.485-.57 1.485-.57.3.75.12 1.305.06 1.44.345.465.555 1.02.555 1.605 0 1.5-1.005 3-2.565 3.375-.3.345-.48.735-.48 1.125.39.015.78.09 1.125.24.69.285 1.335.885 1.335 1.905 0 1.365-.015 2.475-.015 2.82 0 .315.225.69.825.57A8.203 8.203 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Licensing & Certifications Section (Cream Canvas with Editorial Badges) --}}
    <section id="certifications" class="py-28 bg-[#F6F1E7] border-t border-[#D7D8D1]">
        <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="reveal mb-16 flex flex-col md:flex-row md:items-end justify-between gap-6 pb-6 border-b border-[#D7D8D1]">
                <div>
                    <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-[#1D2A35]">
                        Licensing &amp; <span class="font-serif-italic font-normal text-[#D5B98C]">Certifications</span>
                    </h2>
                </div>
                <p class="text-[#1D2A35]/70 max-w-md text-sm sm:text-base font-normal">
                    Sertifikasi dan lisensi profesional yang saya miliki untuk memvalidasi keahlian saya. Klik pada kartu untuk melihat detail sertifikat.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($certifications as $index => $cert)
                    @php
                        $certData = json_encode([
                            'title' => $cert->title,
                            'issuer' => $cert->issuer,
                            'issue_date' => $cert->issue_date?->format('d F Y') ?? '-',
                            'expiration_date' => $cert->expiration_date?->format('d F Y') ?? 'Tanpa Kedaluwarsa',
                            'credential_id' => $cert->credential_id ?: '-',
                            'credential_url' => $cert->credential_url,
                            'image_url' => $cert->image_url,
                        ]);
                    @endphp
                    <div onclick="openCertModal({{ $certData }})" class="editorial-card tilt-card rounded-2xl p-6 flex items-start gap-4 cursor-pointer transition-all reveal reveal-delay-{{ ($index % 3) + 1 }} group hover:border-[#D5B98C]">
                        <div class="w-14 h-14 rounded-xl bg-[#1D2A35] p-2 flex items-center justify-center flex-shrink-0 text-[#D5B98C] border border-[#D7D8D1]/40 overflow-hidden shadow-xs">
                            @if($cert->image_url)
                                <img src="{{ $cert->image_url }}" alt="{{ $cert->title }}" class="w-full h-full object-contain" onerror="this.onerror=null; this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">
                                <div class="hidden w-full h-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#D5B98C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                            @else
                                <svg class="w-6 h-6 text-[#D5B98C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-[#1D2A35] mb-1 text-sm sm:text-base leading-snug truncate group-hover:text-[#467C78] transition-colors" title="{{ $cert->title }}">
                                {{ $cert->title }}
                            </h3>
                            <p class="font-mono text-xs font-semibold text-[#467C78] mb-1.5 uppercase tracking-wider">
                                {{ $cert->issuer }}
                            </p>
                            <p class="text-xs text-[#1D2A35]/60 mb-3">
                                Terbit: {{ $cert->issue_date?->format('M Y') ?? '-' }} 
                                @if($cert->expiration_date)
                                    &bull; Kedaluwarsa: {{ $cert->expiration_date->format('M Y') }}
                                @else
                                    &bull; Tanpa Kedaluwarsa
                                @endif
                            </p>
                            <div class="inline-flex items-center gap-1.5 text-[11px] font-mono font-bold text-[#1D2A35] group-hover:text-[#467C78] transition-colors uppercase tracking-wider">
                                🔍 Lihat Detail &amp; Kredensial &rarr;
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 text-[#1D2A35]/50 font-mono">
                        Belum ada sertifikasi.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Certification Detail Modal Popup (Sharlee Editorial Dark Modal) --}}
    <div id="cert-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-[#1D2A35]/85 backdrop-blur-md transition-opacity duration-300">
        <div class="bg-[#18232C] text-[#F6F1E7] rounded-3xl max-w-3xl w-full p-6 sm:p-8 shadow-2xl relative border border-[#D7D8D1]/20 transform transition-all duration-300 scale-95 opacity-0 max-h-[92vh] overflow-y-auto" id="cert-modal-content">
            <button onclick="closeCertModal()" class="absolute top-5 right-5 text-[#D7D8D1]/70 hover:text-[#D5B98C] w-9 h-9 rounded-full bg-white/5 hover:bg-white/10 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <span class="text-[10px] font-mono font-bold uppercase tracking-widest text-[#D5B98C] px-3 py-1 bg-[#D5B98C]/10 rounded-full inline-block mb-4 border border-[#D5B98C]/30">
                Detail Sertifikasi
            </span>

            <div id="cert-modal-img-container" class="mb-6 rounded-2xl bg-[#0F161C] border border-[#D7D8D1]/15 p-3 sm:p-4 flex flex-col items-center justify-center">
                <img id="cert-modal-img" src="" alt="" class="max-h-[60vh] max-w-full w-auto object-contain rounded-xl shadow-lg block mx-auto" onerror="this.onerror=null; this.classList.add('hidden'); document.getElementById('cert-modal-img-fallback').classList.remove('hidden');">
                <div id="cert-modal-img-fallback" class="hidden w-20 h-20 rounded-2xl bg-[#D5B98C]/15 flex items-center justify-center text-[#D5B98C] my-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div class="w-full flex items-center justify-between pt-3 mt-2 border-t border-white/10">
                    <span class="text-[11px] font-mono text-[#D7D8D1]/60">Dokumen Sertifikat</span>
                    <a id="cert-modal-img-link" href="#" target="_blank" rel="noopener" class="text-xs font-mono text-[#D5B98C] hover:underline flex items-center gap-1.5 font-bold hidden">
                        <span>🔍 Buka Sertifikat Ukuran Penuh &rarr;</span>
                    </a>
                </div>
            </div>

            <h3 id="cert-modal-title" class="text-xl sm:text-2xl font-extrabold text-[#F6F1E7] mb-1 leading-snug"></h3>
            <p id="cert-modal-issuer" class="text-xs sm:text-sm font-mono font-bold text-[#D5B98C] uppercase tracking-wider mb-5"></p>

            <div class="grid grid-cols-2 gap-4 bg-[#121A21] rounded-2xl p-4 mb-6 border border-[#D7D8D1]/10 text-xs sm:text-sm font-mono">
                <div>
                    <p class="text-[#D7D8D1]/60 text-xs uppercase tracking-wider">Tanggal Terbit</p>
                    <p id="cert-modal-issue-date" class="font-bold text-[#F6F1E7] mt-0.5">-</p>
                </div>
                <div>
                    <p class="text-[#D7D8D1]/60 text-xs uppercase tracking-wider">Status Kedaluwarsa</p>
                    <p id="cert-modal-exp-date" class="font-bold text-[#F6F1E7] mt-0.5">-</p>
                </div>
                <div class="col-span-2 border-t border-[#D7D8D1]/10 pt-3">
                    <p class="text-[#D7D8D1]/60 text-xs uppercase tracking-wider">Credential ID</p>
                    <p id="cert-modal-id" class="font-mono font-bold text-[#D5B98C] mt-0.5 break-all">-</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a id="cert-modal-link" href="#" target="_blank" rel="noopener" class="flex-1 btn-editorial-gold py-3 px-5 rounded-xl text-xs sm:text-sm font-bold flex items-center justify-center gap-2">
                    Lihat Kredensial Resmi
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
                <button onclick="closeCertModal()" class="py-3 px-5 border border-[#D7D8D1]/30 text-[#F6F1E7] rounded-xl hover:bg-white/5 font-semibold text-xs sm:text-sm transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        function openCertModal(data) {
            const modal = document.getElementById('cert-modal');
            const content = document.getElementById('cert-modal-content');
            
            document.getElementById('cert-modal-title').textContent = data.title;
            document.getElementById('cert-modal-issuer').textContent = data.issuer;
            document.getElementById('cert-modal-issue-date').textContent = data.issue_date;
            document.getElementById('cert-modal-exp-date').textContent = data.expiration_date;
            document.getElementById('cert-modal-id').textContent = data.credential_id;

            const imgEl = document.getElementById('cert-modal-img');
            const fallbackEl = document.getElementById('cert-modal-img-fallback');
            const linkEl = document.getElementById('cert-modal-link');
            const imgLinkEl = document.getElementById('cert-modal-img-link');

            if (data.image_url) {
                imgEl.src = data.image_url;
                imgEl.classList.remove('hidden');
                fallbackEl.classList.add('hidden');
                if (imgLinkEl) {
                    imgLinkEl.href = data.image_url;
                    imgLinkEl.classList.remove('hidden');
                }
            } else {
                imgEl.classList.add('hidden');
                fallbackEl.classList.remove('hidden');
                if (imgLinkEl) {
                    imgLinkEl.classList.add('hidden');
                }
            }

            if (data.credential_url) {
                linkEl.href = data.credential_url;
                linkEl.classList.remove('hidden');
            } else {
                linkEl.classList.add('hidden');
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeCertModal() {
            const modal = document.getElementById('cert-modal');
            const content = document.getElementById('cert-modal-content');

            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 250);
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeCertModal();
        });

        document.getElementById('cert-modal')?.addEventListener('click', (e) => {
            if (e.target.id === 'cert-modal') closeCertModal();
        });
    </script>

    {{-- Skills Section (Dark Contrast Section: Deep Navy #1D2A35) --}}
    <section id="skills" class="py-28 bg-[#1D2A35] text-[#F6F1E7] border-t border-[#D7D8D1]/10">
        <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="reveal mb-16 flex flex-col md:flex-row md:items-end justify-between gap-6 pb-6 border-b border-[#D7D8D1]/15">
                <div>
                    <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-[#F6F1E7]">
                        My <span class="font-serif-italic font-normal text-[#D5B98C]">Skills</span>
                    </h2>
                </div>
                <p class="text-[#D7D8D1]/70 max-w-md text-sm sm:text-base font-light">
                    Kombinasi bahasa pemrograman, alat analisis, dan pemahaman metodologi data untuk mengekstraksi insight berharga.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($skills as $index => $skill)
                    <div class="editorial-card-dark tilt-card rounded-2xl p-6 flex items-start gap-4 transition-all reveal reveal-delay-{{ ($index % 3) + 1 }} group hover:border-[#467C78]">
                        <div class="w-12 h-12 rounded-xl bg-[#467C78]/20 flex items-center justify-center flex-shrink-0 text-[#D5B98C] border border-[#467C78]/40 shadow-xs group-hover:scale-110 transition-transform">
                            @include('partials.skill-icon', ['icon' => $skill['icon'] ?? 'chart', 'class' => 'w-6 h-6 text-[#D5B98C]'])
                        </div>
                        <div>
                            <h3 class="font-bold text-[#F6F1E7] mb-1 group-hover:text-[#D5B98C] transition-colors">{{ $skill['name'] }}</h3>
                            <p class="text-xs text-[#D7D8D1]/70 font-mono">{{ $skill['detail'] ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Contact Section (Deep Navy Canvas with Gold Accents) --}}
    <section id="contact" class="py-28 bg-[#18232C] text-[#F6F1E7] border-t border-[#D7D8D1]/10">
        <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="reveal text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-[#F6F1E7] mb-4">
                    Get In <span class="font-serif-italic font-normal text-[#D5B98C]">Touch</span>
                </h2>
                <p class="text-[#D7D8D1]/80 text-sm sm:text-base font-light">
                    Tertarik berkolaborasi? Hubungi saya melalui channel berikut.
                </p>
                <div class="w-12 h-0.5 bg-[#467C78] mx-auto mt-6"></div>
            </div>

            <div class="reveal flex flex-wrap justify-center gap-6 max-w-4xl mx-auto">
                @if($settings->email)
                    <a href="mailto:{{ $settings->email }}" class="editorial-card-dark tilt-card rounded-2xl px-8 py-6 flex items-center gap-4 hover:border-[#D5B98C] shadow-lg flex-1 min-w-[260px] group">
                        <div class="w-12 h-12 rounded-xl bg-[#D5B98C]/15 flex items-center justify-center text-[#D5B98C] flex-shrink-0 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="font-mono text-xs uppercase tracking-widest text-[#D7D8D1]/60">Email</p>
                            <p class="text-[#F6F1E7] font-bold text-sm sm:text-base group-hover:text-[#D5B98C] transition-colors break-all">{{ $settings->email }}</p>
                        </div>
                    </a>
                @endif

                @if($settings->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/\D+/', '', $settings->whatsapp) }}" target="_blank" rel="noopener" class="editorial-card-dark tilt-card rounded-2xl px-8 py-6 flex items-center gap-4 hover:border-[#467C78] shadow-lg flex-1 min-w-[260px] group">
                        <div class="w-12 h-12 rounded-xl bg-[#467C78]/20 flex items-center justify-center text-[#467C78] flex-shrink-0 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.33 4.95L2 22l5.28-1.39a9.9 9.9 0 004.76 1.21h.01c5.46 0 9.91-4.45 9.91-9.91S17.51 2 12.04 2zm0 18.14h-.01a8.2 8.2 0 01-4.18-1.14l-.3-.18-3.13.82.84-3.05-.2-.31a8.18 8.18 0 01-1.25-4.36c0-4.54 3.69-8.23 8.23-8.23 2.2 0 4.26.86 5.82 2.41a8.18 8.18 0 012.41 5.82c0 4.53-3.69 8.22-8.23 8.22zm4.51-6.16c-.25-.12-1.46-.72-1.69-.8-.23-.08-.39-.12-.56.12-.16.25-.64.8-.78.96-.14.16-.29.18-.54.06-.25-.12-1.04-.38-1.98-1.22-.73-.65-1.23-1.46-1.37-1.7-.14-.25-.02-.38.11-.5.11-.11.25-.29.37-.43.12-.14.16-.25.25-.41.08-.16.04-.31-.02-.43-.06-.12-.56-1.35-.77-1.85-.2-.49-.41-.42-.56-.43h-.48c-.16 0-.43.06-.66.31-.23.25-.86.84-.86 2.04s.88 2.37 1 2.53c.12.16 1.73 2.64 4.19 3.7.59.25 1.04.4 1.4.52.59.19 1.12.16 1.54.1.47-.07 1.46-.6 1.66-1.18.21-.58.21-1.08.14-1.18-.06-.11-.23-.17-.48-.29z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="font-mono text-xs uppercase tracking-widest text-[#D7D8D1]/60">WhatsApp</p>
                            <p class="text-[#F6F1E7] font-bold text-sm sm:text-base group-hover:text-[#467C78] transition-colors">{{ $settings->whatsapp }}</p>
                        </div>
                    </a>
                @endif

                @if($settings->linkedin)
                    <a href="{{ $settings->linkedin }}" target="_blank" rel="noopener" class="editorial-card-dark tilt-card rounded-2xl px-8 py-6 flex items-center gap-4 hover:border-[#D5B98C] shadow-lg flex-1 min-w-[260px] group">
                        <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center text-[#D5B98C] flex-shrink-0 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 114.128 0 2.063 2.063 0 01-2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="font-mono text-xs uppercase tracking-widest text-[#D7D8D1]/60">LinkedIn</p>
                            <p class="text-[#F6F1E7] font-bold text-sm sm:text-base group-hover:text-[#D5B98C] transition-colors">Connect</p>
                        </div>
                    </a>
                @endif

                @if($settings->github)
                    <a href="{{ $settings->github }}" target="_blank" rel="noopener" class="editorial-card-dark tilt-card rounded-2xl px-8 py-6 flex items-center gap-4 hover:border-[#D5B98C] shadow-lg flex-1 min-w-[260px] group">
                        <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center text-[#F6F1E7] flex-shrink-0 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.395-.135-.345-.72-1.395-1.23-1.895-.42-.405-1.02-.78-1.23-.99-.405-.33-.015-.33.015-.33.42 0 .855.195 1.23.57.405.405.54.54 1.32.54.78 0 1.335-.255 1.665-.78.45-.855 1.245-1.215 1.935-1.275.54-.045 1.05-.195 1.5-.405-.015-.39-.165-.78-.465-1.125C16.335 9.585 15.33 8.085 15.33 6.585c0-.585.21-1.14.555-1.605-.06-.135-.24-.69.06-1.44 0 0 .45-.15 1.485.57.435-.12.885-.18 1.335-.18.45 0 .9.06 1.335.18 1.035-.72 1.485-.57 1.485-.57.3.75.12 1.305.06 1.44.345.465.555 1.02.555 1.605 0 1.5-1.005 3-2.565 3.375-.3.345-.48.735-.48 1.125.39.015.78.09 1.125.24.69.285 1.335.885 1.335 1.905 0 1.365-.015 2.475-.015 2.82 0 .315.225.69.825.57A8.203 8.203 0 0024 12c0-6.63-5.37-12-12-12z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="font-mono text-xs uppercase tracking-widest text-[#D7D8D1]/60">GitHub</p>
                            <p class="text-[#F6F1E7] font-bold text-sm sm:text-base group-hover:text-[#D5B98C] transition-colors">View Profile</p>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </section>
@endsection
