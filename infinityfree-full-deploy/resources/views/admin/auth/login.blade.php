<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Portfolio</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="admin-body font-sans antialiased flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8">
        <div class="admin-card p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-slate-900">Admin Login</h1>
                <p class="text-slate-500 text-sm mt-2">Kelola proyek portofolio Anda</p>
            </div>

            @if(session('error'))
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="username" class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}" required
                           autocomplete="username"
                           class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 outline-none">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                           autocomplete="current-password"
                           class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 outline-none">
                </div>
                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-cyan-600">
                    Ingat saya
                </label>
                <button type="submit" class="w-full py-3 bg-gradient-to-r from-cyan-500 to-cyan-600 text-white font-medium rounded-lg hover:from-cyan-600 hover:to-cyan-700 transition">
                    Login
                </button>
            </form>

            <p class="text-center mt-6 text-sm text-slate-500">
                <a href="{{ route('portfolio.index') }}" class="text-cyan-600 hover:underline">← Kembali ke Website</a>
            </p>
        </div>
    </div>
</body>
</html>
