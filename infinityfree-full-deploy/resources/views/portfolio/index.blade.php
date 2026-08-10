@extends('layouts.portfolio')

@section('content')
    {{-- Hero Section --}}
    <section id="home" class="relative min-h-[90vh] flex items-center pt-8 overflow-hidden bg-gradient-to-b from-blue-50/30 via-transparent to-transparent">
        <div class="hero-glow top-10 -left-40"></div>
        <div class="hero-glow bottom-10 -right-40" style="background: radial-gradient(circle, rgba(34, 197, 94, 0.04) 0%, transparent 70%);"></div>

        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 relative">
            <div class="grid lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7 reveal text-center lg:text-left">
                    <p class="text-blue-600 font-semibold mb-3 tracking-wide uppercase text-sm">Hello, I'm</p>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight text-slate-900 mb-4 tracking-tight">
                        <span class="gradient-text">{{ $settings->name }}</span>
                    </h1>
                    <h2 class="text-2xl sm:text-3xl text-slate-700 font-medium mb-6">{{ $settings->title }}</h2>
                    <p class="text-lg text-slate-500 leading-relaxed mb-8 max-w-xl mx-auto lg:mx-0">
                        {{ $settings->tagline ?? 'Passionate about data, insights, and visualization' }}
                    </p>
                    <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                        <a href="#projects" class="btn-primary px-7 py-3.5 rounded-xl text-white font-semibold text-sm shadow-lg shadow-blue-500/20 hover:shadow-xl hover:shadow-blue-500/30 transition-all">
                            Lihat Project
                        </a>
                        <a href="#contact" class="btn-outline px-7 py-3.5 rounded-xl text-blue-600 font-semibold text-sm border border-blue-500/30 hover:border-blue-500 transition-all">
                            Contact Me
                        </a>
                    </div>
                </div>

                {{-- Hero Visual (Profile Picture / Data Insight Visualization) --}}
                <div class="lg:col-span-5 reveal reveal-delay-2 flex justify-center">
                    <div class="relative w-full max-w-[360px] aspect-square">
                        {{-- Background decorative shapes --}}
                        <div class="absolute -inset-4 bg-gradient-to-tr from-blue-500 to-emerald-500 rounded-3xl opacity-10 blur-lg -rotate-3"></div>
                        <div class="absolute inset-0 bg-white rounded-3xl shadow-[0_20px_50px_rgba(15,23,42,0.06)] border border-slate-100 p-3">
                            <div class="w-full h-full rounded-2xl overflow-hidden relative group">
                                @if($settings->avatar_path)
                                    <img src="{{ asset('storage/' . $settings->avatar_path) }}" alt="{{ $settings->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-50 to-emerald-50 flex flex-col items-center justify-center text-center p-6">
                                        <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <span class="text-2xl font-bold text-slate-800 tracking-tight">{{ $settings->name }}</span>
                                        <span class="text-sm text-slate-500 mt-1">{{ $settings->title }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Floating Micro cards --}}
                        <div class="absolute -right-6 -bottom-6 bg-white p-4 rounded-2xl shadow-lg border border-slate-100 flex items-center gap-3 animate-bounce" style="animation-duration: 4s;">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0 text-emerald-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs text-slate-400">Total Proyek</div>
                                <div class="text-base font-bold text-slate-800">{{ $projects->count() }}+ Proyek</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section-divider max-w-[1200px] mx-auto"></div>

    {{-- About Section --}}
    <section id="about" class="py-24 bg-white/40">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="reveal text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mb-3 tracking-tight">About <span class="gradient-text">Me</span></h2>
                <div class="w-12 h-1 bg-gradient-to-r from-blue-500 to-emerald-500 mx-auto rounded-full"></div>
            </div>

            <div class="grid lg:grid-cols-12 gap-12 items-center">
                {{-- About Left (Profile image if not shown in hero, or dynamic decoration) --}}
                <div class="lg:col-span-5 reveal flex justify-center">
                    <div class="bg-slate-50 border border-slate-100 rounded-3xl p-6 w-full max-w-[380px] shadow-sm relative">
                        <div class="flex items-center gap-1.5 mb-6">
                            <span class="w-3 h-3 rounded-full bg-red-400"></span>
                            <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
                            <span class="w-3 h-3 rounded-full bg-green-400"></span>
                        </div>
                        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-xs mb-4">
                            <div class="flex items-end gap-1.5 h-28 mb-3">
                                @foreach([35, 60, 40, 75, 50, 95, 70] as $h)
                                    <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-400 rounded-t-md transition-all hover:opacity-80" style="height: {{ $h }}%"></div>
                                @endforeach
                            </div>
                            <p class="text-xs font-semibold text-slate-400 text-center uppercase tracking-wider">Data Analytics Activity</p>
                        </div>
                        <div class="text-center bg-blue-500/5 border border-blue-500/10 rounded-xl py-3 px-4">
                            <span class="text-sm font-semibold text-blue-600">Turning Data into Actionable Insights</span>
                        </div>
                    </div>
                </div>

                {{-- About Right (Text details) --}}
                <div class="lg:col-span-7 reveal reveal-delay-1">
                    <p class="text-slate-600 leading-relaxed mb-8 text-lg">
                        {{ $settings->about_bio }}
                    </p>
                    
                    @if($settings->career_goal)
                        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm shadow-slate-100/50">
                            <h3 class="text-blue-600 font-bold text-lg mb-3 flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                    </svg>
                                </span>
                                Career Goal
                            </h3>
                            <p class="text-slate-500 leading-relaxed text-sm">{{ $settings->career_goal }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="section-divider max-w-[1200px] mx-auto"></div>

    {{-- Projects Section --}}
    <section id="projects" class="py-24">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="reveal text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mb-3 tracking-tight">Featured <span class="gradient-text">Projects</span></h2>
                <p class="text-slate-500 max-w-2xl mx-auto text-sm sm:text-base">Kumpulan proyek analisis data yang menunjukkan kemampuan saya dalam mengolah data menjadi insight.</p>
                <div class="w-12 h-1 bg-gradient-to-r from-blue-500 to-emerald-500 mx-auto rounded-full mt-4"></div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects as $index => $project)
                    <article class="project-card reveal reveal-delay-{{ ($index % 3) + 1 }} bg-white border border-slate-100 rounded-2xl overflow-hidden flex flex-col">
                        {{-- Project image --}}
                        <div class="aspect-video img-placeholder overflow-hidden relative group">
                            @if($project->image_url)
                                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-50">
                                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div class="p-6 flex flex-col flex-1">
                            @if($project->project_date)
                                <p class="text-xs font-semibold text-blue-600 mb-2 uppercase tracking-wider">{{ $project->project_date->format('M Y') }}</p>
                            @endif
                            <h3 class="text-lg font-bold text-slate-900 mb-2 hover:text-blue-600 transition-colors">
                                <a href="{{ route('portfolio.project', $project) }}">{{ $project->title }}</a>
                            </h3>
                            <p class="text-slate-500 text-sm mb-5 leading-relaxed flex-1">{{ \Illuminate\Support\Str::limit($project->description, 110) }}</p>

                            {{-- Tools tags --}}
                            @if($project->tools)
                                <div class="flex flex-wrap gap-1.5 mb-6">
                                    @foreach($project->tools as $tool)
                                        <span class="text-xs px-2.5 py-1 rounded-full bg-blue-50 text-blue-600 font-medium border border-blue-100/50">{{ $tool }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <div class="flex items-center justify-between pt-4 border-t border-slate-50 mt-auto">
                                <a href="{{ route('portfolio.project', $project) }}" class="text-sm text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-1">
                                    Detail Proyek
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                                @if($project->github_link)
                                    <a href="{{ $project->github_link }}" target="_blank" rel="noopener" class="text-slate-400 hover:text-slate-600 transition-colors" title="GitHub Repository">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.395-.135-.345-.72-1.395-1.23-1.895-.42-.405-1.02-.78-1.23-.99-.405-.33-.015-.33.015-.33.42 0 .855.195 1.23.57.405.405.54.54 1.32.54.78 0 1.335-.255 1.665-.78.45-.855 1.245-1.215 1.935-1.275.54-.045 1.05-.195 1.5-.405-.015-.39-.165-.78-.465-1.125C16.335 9.585 15.33 8.085 15.33 6.585c0-.585.21-1.14.555-1.605-.06-.135-.24-.69.06-1.44 0 0 .45-.15 1.485.57.435-.12.885-.18 1.335-.18.45 0 .9.06 1.335.18 1.035-.72 1.485-.57 1.485-.57.3.75.12 1.305.06 1.44.345.465.555 1.02.555 1.605 0 1.5-1.005 3-2.565 3.375-.3.345-.48.735-.48 1.125.39.015.78.09 1.125.24.69.285 1.335.885 1.335 1.905 0 1.365-.015 2.475-.015 2.82 0 .315.225.69.825.57A8.203 8.203 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12 text-slate-400">
                        Belum ada proyek. Login ke admin untuk menambahkan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <div class="section-divider max-w-[1200px] mx-auto"></div>

    {{-- Certifications Section --}}
    <section id="certifications" class="py-24 bg-white/40">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="reveal text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mb-3 tracking-tight">Licensing & <span class="gradient-text">Certifications</span></h2>
                <p class="text-slate-500 max-w-2xl mx-auto text-sm sm:text-base">Sertifikasi dan lisensi profesional yang saya miliki untuk memvalidasi keahlian saya.</p>
                <div class="w-12 h-1 bg-gradient-to-r from-blue-500 to-emerald-500 mx-auto rounded-full mt-4"></div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($certifications as $index => $cert)
                    <div class="skill-card reveal reveal-delay-{{ ($index % 3) + 1 }} bg-white border border-slate-100 rounded-2xl p-6 flex items-start gap-4 shadow-sm shadow-slate-100/30">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0 text-blue-600 border border-blue-100/30 overflow-hidden">
                            @if($cert->image_url)
                                <img src="{{ $cert->image_url }}" alt="{{ $cert->title }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-slate-800 mb-1 text-sm sm:text-base leading-snug truncate" title="{{ $cert->title }}">{{ $cert->title }}</h3>
                            <p class="text-xs font-semibold text-blue-600 mb-1.5 uppercase tracking-wider">{{ $cert->issuer }}</p>
                            <p class="text-xs text-slate-400 mb-4">
                                Terbit: {{ $cert->issue_date?->format('M Y') ?? '-' }} 
                                @if($cert->expiration_date)
                                    &bull; Kedaluwarsa: {{ $cert->expiration_date->format('M Y') }}
                                @else
                                    &bull; Tanpa Kedaluwarsa
                                @endif
                            </p>
                            @if($cert->credential_url)
                                <a href="{{ $cert->credential_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-blue-600 transition-colors uppercase tracking-wider">
                                    Lihat Kredensial
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-slate-400">
                        Belum ada sertifikasi.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <div class="section-divider max-w-[1200px] mx-auto"></div>

    {{-- Skills Section --}}
    <section id="skills" class="py-24 bg-white/40">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="reveal text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mb-3 tracking-tight">My <span class="gradient-text">Skills</span></h2>
                <div class="w-12 h-1 bg-gradient-to-r from-blue-500 to-emerald-500 mx-auto rounded-full"></div>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($skills as $index => $skill)
                    <div class="skill-card reveal reveal-delay-{{ ($index % 3) + 1 }} bg-white border border-slate-100 rounded-2xl p-6 flex items-start gap-4 shadow-sm shadow-slate-100/30">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0 text-blue-600 border border-blue-100/30">
                            @include('partials.skill-icon', ['icon' => $skill['icon'] ?? 'chart'])
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-800 mb-1">{{ $skill['name'] }}</h3>
                            <p class="text-sm text-slate-400">{{ $skill['detail'] ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section-divider max-w-[1200px] mx-auto"></div>

    {{-- Contact Section --}}
    <section id="contact" class="py-24">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="reveal text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mb-3 tracking-tight">Get In <span class="gradient-text">Touch</span></h2>
                <p class="text-slate-500 max-w-2xl mx-auto text-sm sm:text-base">Tertarik berkolaborasi? Hubungi saya melalui channel berikut.</p>
                <div class="w-12 h-1 bg-gradient-to-r from-blue-500 to-emerald-500 mx-auto rounded-full mt-4"></div>
            </div>

            <div class="reveal flex flex-wrap justify-center gap-6">
                @if($settings->email)
                    <a href="mailto:{{ $settings->email }}" class="skill-card bg-white border border-slate-100 rounded-2xl px-8 py-6 flex items-center gap-4 hover:border-blue-300 shadow-sm">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Email</p>
                            <p class="text-slate-700 font-bold text-sm sm:text-base">{{ $settings->email }}</p>
                        </div>
                    </a>
                @endif

                @if($settings->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/\D+/', '', $settings->whatsapp) }}" target="_blank" rel="noopener" class="skill-card bg-white border border-slate-100 rounded-2xl px-8 py-6 flex items-center gap-4 hover:border-emerald-300 shadow-sm">
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 flex-shrink-0">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.33 4.95L2 22l5.28-1.39a9.9 9.9 0 004.76 1.21h.01c5.46 0 9.91-4.45 9.91-9.91S17.51 2 12.04 2zm0 18.14h-.01a8.2 8.2 0 01-4.18-1.14l-.3-.18-3.13.82.84-3.05-.2-.31a8.18 8.18 0 01-1.25-4.36c0-4.54 3.69-8.23 8.23-8.23 2.2 0 4.26.86 5.82 2.41a8.18 8.18 0 012.41 5.82c0 4.53-3.69 8.22-8.23 8.22zm4.51-6.16c-.25-.12-1.46-.72-1.69-.8-.23-.08-.39-.12-.56.12-.16.25-.64.8-.78.96-.14.16-.29.18-.54.06-.25-.12-1.04-.38-1.98-1.22-.73-.65-1.23-1.46-1.37-1.7-.14-.25-.02-.38.11-.5.11-.11.25-.29.37-.43.12-.14.16-.25.25-.41.08-.16.04-.31-.02-.43-.06-.12-.56-1.35-.77-1.85-.2-.49-.41-.42-.56-.43h-.48c-.16 0-.43.06-.66.31-.23.25-.86.84-.86 2.04s.88 2.37 1 2.53c.12.16 1.73 2.64 4.19 3.7.59.25 1.04.4 1.4.52.59.19 1.12.16 1.54.1.47-.07 1.46-.6 1.66-1.18.21-.58.21-1.08.14-1.18-.06-.11-.23-.17-.48-.29z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">WhatsApp</p>
                            <p class="text-slate-700 font-bold text-sm sm:text-base">{{ $settings->whatsapp }}</p>
                        </div>
                    </a>
                @endif

                @if($settings->linkedin)
                    <a href="{{ $settings->linkedin }}" target="_blank" rel="noopener" class="skill-card bg-white border border-slate-100 rounded-2xl px-8 py-6 flex items-center gap-4 hover:border-blue-400 shadow-sm">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-[#0A66C2] flex-shrink-0">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 114.128 0 2.063 2.063 0 01-2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">LinkedIn</p>
                            <p class="text-slate-700 font-bold text-sm sm:text-base">Connect</p>
                        </div>
                    </a>
                @endif

                @if($settings->github)
                    <a href="{{ $settings->github }}" target="_blank" rel="noopener" class="skill-card bg-white border border-slate-100 rounded-2xl px-8 py-6 flex items-center gap-4 hover:border-slate-300 shadow-sm">
                        <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center text-slate-800 flex-shrink-0">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.395-.135-.345-.72-1.395-1.23-1.895-.42-.405-1.02-.78-1.23-.99-.405-.33-.015-.33.015-.33.42 0 .855.195 1.23.57.405.405.54.54 1.32.54.78 0 1.335-.255 1.665-.78.45-.855 1.245-1.215 1.935-1.275.54-.045 1.05-.195 1.5-.405-.015-.39-.165-.78-.465-1.125C16.335 9.585 15.33 8.085 15.33 6.585c0-.585.21-1.14.555-1.605-.06-.135-.24-.69.06-1.44 0 0 .45-.15 1.485.57.435-.12.885-.18 1.335-.18.45 0 .9.06 1.335.18 1.035-.72 1.485-.57 1.485-.57.3.75.12 1.305.06 1.44.345.465.555 1.02.555 1.605 0 1.5-1.005 3-2.565 3.375-.3.345-.48.735-.48 1.125.39.015.78.09 1.125.24.69.285 1.335.885 1.335 1.905 0 1.365-.015 2.475-.015 2.82 0 .315.225.69.825.57A8.203 8.203 0 0024 12c0-6.63-5.37-12-12-12z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">GitHub</p>
                            <p class="text-slate-700 font-bold text-sm sm:text-base">View Profile</p>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </section>
@endsection
