<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $settings->name }} - {{ $settings->title }} Portfolio">
    <title>@yield('title', $settings->name . ' | Data Analyst Portfolio')</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/portfolio.js'])
</head>
<body class="portfolio-body antialiased text-[#0F172A] bg-[#F8FAFC]">
    {{-- Navigation --}}
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="#home" class="text-xl font-bold gradient-text">{{ $settings->name }}</a>

                {{-- Desktop nav --}}
                <div class="hidden md:flex items-center gap-6">
                    <a href="#home" class="nav-link text-sm font-medium text-slate-600 hover:text-slate-900">Home</a>
                    <a href="#about" class="nav-link text-sm font-medium text-slate-600 hover:text-slate-900">About</a>
                    <a href="#projects" class="nav-link text-sm font-medium text-slate-600 hover:text-slate-900">Projects</a>
                    <a href="#skills" class="nav-link text-sm font-medium text-slate-600 hover:text-slate-900">Skills</a>
                    <a href="#certifications" class="nav-link text-sm font-medium text-slate-600 hover:text-slate-900">Certifications</a>
                    <a href="#contact" class="nav-link text-sm font-medium text-slate-600 hover:text-slate-900">Contact</a>
                    <a href="{{ route('admin.login') }}" class="ml-2 px-4 py-2 text-sm font-semibold rounded-xl border border-blue-500/20 text-blue-600 hover:bg-blue-50 transition">
                        Login
                    </a>
                </div>

                <div class="flex md:hidden items-center gap-3">
                    <a href="{{ route('admin.login') }}" class="px-3.5 py-1.5 text-xs font-semibold rounded-lg border border-blue-500/20 text-blue-600">Login</a>
                    <button id="mobile-toggle" class="text-slate-600 hover:text-slate-900" aria-label="Menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    {{-- Mobile menu overlay --}}
    <div id="mobile-menu" class="mobile-menu fixed inset-0 z-50 bg-white/98 md:hidden">
        <div class="flex flex-col items-center justify-center h-full gap-8">
            <button id="mobile-close" class="absolute top-6 right-6 text-slate-600" aria-label="Close">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <a href="#home" class="text-2xl text-slate-700 hover:text-blue-600 font-medium">Home</a>
            <a href="#about" class="text-2xl text-slate-700 hover:text-blue-600 font-medium">About</a>
            <a href="#projects" class="text-2xl text-slate-700 hover:text-blue-600 font-medium">Projects</a>
            <a href="#skills" class="text-2xl text-slate-700 hover:text-blue-600 font-medium">Skills</a>
            <a href="#certifications" class="text-2xl text-slate-700 hover:text-blue-600 font-medium">Certifications</a>
            <a href="#contact" class="text-2xl text-slate-700 hover:text-blue-600 font-medium">Contact</a>
            <a href="{{ route('admin.login') }}" class="text-2xl text-blue-600 hover:text-blue-700 font-semibold">Login Admin</a>
        </div>
    </div>

    <main class="pt-16">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="border-t border-slate-100 py-8 bg-white">
        <div class="max-w-[1200px] mx-auto px-4 text-center">
            <p class="text-slate-400 text-sm">
                &copy; {{ date('Y') }} {{ $settings->name }}. Built with Laravel & Tailwind CSS.
            </p>
        </div>
    </footer>
</body>
</html>
