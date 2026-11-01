<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $settings->name }} - {{ $settings->title }} Portfolio">
    <title>@yield('title', $settings->name . ' | Data Analyst & Insights')</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/portfolio.js'])
</head>
<body class="portfolio-body antialiased text-[#1D2A35] bg-[#F6F1E7] selection:bg-[#D5B98C] selection:text-[#1D2A35]">
    {{-- Interactive Welcome Screen --}}
    @if(request()->routeIs('portfolio.index'))
        @include('partials.welcome-screen')
    @endif

    {{-- Minimalist Editorial Navigation --}}
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 py-4">
        <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-14 px-5 rounded-2xl bg-[#F6F1E7]/80 backdrop-blur-md border border-[#D7D8D1]/80 shadow-xs transition-all duration-300" id="navbar-container">
                {{-- Logo / Brand --}}
                <a href="{{ route('portfolio.index') }}#home" class="group flex items-center">
                    <span class="font-bold text-[#1D2A35] text-base tracking-tight group-hover:text-[#467C78] transition-colors">
                        {{ $settings->name }}
                    </span>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('portfolio.index') }}#home" class="nav-editorial text-xs font-semibold tracking-wider uppercase text-[#1D2A35]/80 hover:text-[#1D2A35]">Home</a>
                    <a href="{{ route('portfolio.index') }}#about" class="nav-editorial text-xs font-semibold tracking-wider uppercase text-[#1D2A35]/80 hover:text-[#1D2A35]">About</a>
                    <a href="{{ route('portfolio.index') }}#projects" class="nav-editorial text-xs font-semibold tracking-wider uppercase text-[#1D2A35]/80 hover:text-[#1D2A35]">Projects</a>
                    <a href="{{ route('portfolio.index') }}#skills" class="nav-editorial text-xs font-semibold tracking-wider uppercase text-[#1D2A35]/80 hover:text-[#1D2A35]">Skills</a>
                    <a href="{{ route('portfolio.index') }}#certifications" class="nav-editorial text-xs font-semibold tracking-wider uppercase text-[#1D2A35]/80 hover:text-[#1D2A35]">Certifications</a>
                    <a href="{{ route('portfolio.index') }}#contact" class="nav-editorial text-xs font-semibold tracking-wider uppercase text-[#1D2A35]/80 hover:text-[#1D2A35]">Contact</a>

                    <div class="h-4 w-px bg-[#D7D8D1]/80"></div>

                    {{-- Sound FX Toggle --}}
                    <button id="sound-toggle-btn" type="button" class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-xl border border-[#D7D8D1]/80 hover:border-[#D5B98C] text-[#1D2A35]/60 text-[11px] font-mono transition-colors cursor-pointer" title="Sound FX (Default Off)">
                        <span class="flex items-end gap-0.5 h-3">
                            <span class="sound-bar"></span>
                            <span class="sound-bar"></span>
                            <span class="sound-bar"></span>
                        </span>
                        <span id="sound-toggle-label">SFX: OFF</span>
                    </button>
                </div>

                {{-- Mobile Toggle & Quick Actions --}}
                <div class="flex md:hidden items-center gap-2">
                    <button id="mobile-toggle" class="p-2 text-[#1D2A35] hover:text-[#467C78] transition-colors" aria-label="Toggle Menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 7h16M4 12h16M4 17h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    {{-- Mobile Menu Overlay --}}
    <div id="mobile-menu" class="mobile-menu fixed inset-0 z-50 bg-[#1D2A35] text-[#F6F1E7] md:hidden transform transition-all duration-300 -translate-y-full opacity-0 pointer-events-none flex flex-col justify-between p-8">
        <div class="flex items-center justify-between border-b border-[#D7D8D1]/20 pb-4">
            <div class="flex items-center gap-2.5">
                <span class="w-7 h-7 rounded bg-[#D5B98C] text-[#1D2A35] flex items-center justify-center font-bold text-xs">
                    {{ strtoupper(substr($settings->name, 0, 1)) }}
                </span>
                <span class="font-bold text-sm tracking-tight text-[#F6F1E7]">{{ $settings->name }}</span>
            </div>
            <button id="mobile-close" class="p-2 text-[#D7D8D1] hover:text-[#D5B98C] transition-colors" aria-label="Close Menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="flex flex-col gap-6 my-auto text-left py-6">
            <span class="text-[11px] font-mono uppercase tracking-widest text-[#D5B98C]">[ Navigasi ]</span>
            <a href="{{ route('portfolio.index') }}#home" class="mobile-link text-3xl font-extrabold tracking-tight text-[#F6F1E7] hover:text-[#D5B98C] transition-colors">01. Home</a>
            <a href="{{ route('portfolio.index') }}#about" class="mobile-link text-3xl font-extrabold tracking-tight text-[#F6F1E7] hover:text-[#D5B98C] transition-colors">02. About</a>
            <a href="{{ route('portfolio.index') }}#projects" class="mobile-link text-3xl font-extrabold tracking-tight text-[#F6F1E7] hover:text-[#D5B98C] transition-colors">03. Projects</a>
            <a href="{{ route('portfolio.index') }}#skills" class="mobile-link text-3xl font-extrabold tracking-tight text-[#F6F1E7] hover:text-[#D5B98C] transition-colors">04. Skills</a>
            <a href="{{ route('portfolio.index') }}#certifications" class="mobile-link text-3xl font-extrabold tracking-tight text-[#F6F1E7] hover:text-[#D5B98C] transition-colors">05. Certifications</a>
            <a href="{{ route('portfolio.index') }}#contact" class="mobile-link text-3xl font-extrabold tracking-tight text-[#F6F1E7] hover:text-[#D5B98C] transition-colors">06. Contact</a>
        </div>

        <div class="pt-6 border-t border-[#D7D8D1]/20 flex items-center justify-between text-xs text-[#D7D8D1]/60 font-mono">
            <span>{{ $settings->name }}</span>
            <span>&copy; {{ date('Y') }}</span>
        </div>
    </div>

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer with Editorial Dark Contrast --}}
    <footer class="bg-[#1D2A35] text-[#F6F1E7] border-t border-[#D7D8D1]/10 pt-16 pb-12">
        <div class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-12 gap-8 items-center pb-12 border-b border-[#D7D8D1]/15">
                <div class="md:col-span-6">
                    <h3 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#F6F1E7]">
                        {{ $settings->name }}
                    </h3>
                    <p class="text-sm text-[#D7D8D1] mt-1 max-w-md">
                        {{ $settings->title }} &mdash; {{ $settings->tagline }}
                    </p>
                </div>
                <div class="md:col-span-6 flex flex-wrap md:justify-end gap-3">
                    @if($settings->email)
                        <a href="mailto:{{ $settings->email }}" class="px-4 py-2 rounded-xl bg-[#F6F1E7]/10 hover:bg-[#467C78] text-[#F6F1E7] text-xs font-mono transition-colors">
                            Email ↗
                        </a>
                    @endif
                    @if($settings->whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/\D+/', '', $settings->whatsapp) }}" target="_blank" rel="noopener" class="px-4 py-2 rounded-xl bg-[#F6F1E7]/10 hover:bg-[#467C78] text-[#F6F1E7] text-xs font-mono transition-colors">
                            WhatsApp ↗
                        </a>
                    @endif
                    @if($settings->linkedin)
                        <a href="{{ $settings->linkedin }}" target="_blank" rel="noopener" class="px-4 py-2 rounded-xl bg-[#F6F1E7]/10 hover:bg-[#467C78] text-[#F6F1E7] text-xs font-mono transition-colors">
                            LinkedIn ↗
                        </a>
                    @endif
                    @if($settings->github)
                        <a href="{{ $settings->github }}" target="_blank" rel="noopener" class="px-4 py-2 rounded-xl bg-[#F6F1E7]/10 hover:bg-[#467C78] text-[#F6F1E7] text-xs font-mono transition-colors">
                            GitHub ↗
                        </a>
                    @endif
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-mono text-[#D7D8D1]/60">
                <p>&copy; {{ date('Y') }} {{ $settings->name }}. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
