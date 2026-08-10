<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | Portfolio Admin</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">
    @vite(['resources/css/app.css'])
</head>
<body class="admin-body font-sans antialiased">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="admin-sidebar w-64 text-white flex-shrink-0 hidden lg:flex flex-col">
            <div class="p-6 border-b border-slate-700">
                <h1 class="text-lg font-bold">Portfolio Admin</h1>
                <p class="text-xs text-slate-400 mt-1">{{ auth()->user()->name }}</p>
            </div>
            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-cyan-500/20 text-cyan-400' : 'text-slate-300 hover:bg-slate-700/50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.projects.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.projects.*') ? 'bg-cyan-500/20 text-cyan-400' : 'text-slate-300 hover:bg-slate-700/50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    Projects
                </a>
                <a href="{{ route('admin.certifications.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.certifications.*') ? 'bg-cyan-500/20 text-cyan-400' : 'text-slate-300 hover:bg-slate-700/50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    Sertifikasi
                </a>
                <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.profile.*') ? 'bg-cyan-500/20 text-cyan-400' : 'text-slate-300 hover:bg-slate-700/50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profil
                </a>
                <a href="{{ route('portfolio.index') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-700/50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Lihat Website
                </a>
            </nav>
            <div class="p-4 border-t border-slate-700">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-red-400 hover:bg-red-500/10 text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main content --}}
        <div class="flex-1 flex flex-col">
            {{-- Mobile header --}}
            <header class="lg:hidden bg-slate-900 text-white p-4 flex items-center justify-between">
                <span class="font-bold">Admin</span>
                <div class="flex gap-2 items-center">
                    <a href="{{ route('admin.dashboard') }}" class="text-sm text-cyan-400">Home</a>
                    <a href="{{ route('admin.projects.index') }}" class="text-sm text-cyan-400">Projects</a>
                    <a href="{{ route('admin.certifications.index') }}" class="text-sm text-cyan-400">Sertifikasi</a>
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-red-400 ml-1">Logout</button>
                    </form>
                </div>
            </header>

            <main class="flex-1 p-6 lg:p-8">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg text-sm">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    {{-- Reusable Cropper Modal --}}
    <div id="cropper-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs hidden">
        <div class="bg-white rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl flex flex-col max-h-[90vh]">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-white">
                <h3 class="font-bold text-slate-900 text-lg">✂️ Sesuaikan Area Foto</h3>
                <button type="button" id="cropper-close" class="text-slate-400 hover:text-slate-600 font-bold text-xl">✕</button>
            </div>
            <div class="p-6 overflow-hidden flex-1 flex flex-col justify-center items-center bg-slate-50 min-h-[300px]">
                <div class="max-w-full max-h-[50vh] overflow-hidden rounded-xl">
                    <img id="cropper-image" src="" alt="Source Image" class="max-w-full block">
                </div>
            </div>
            <div class="p-6 border-t border-slate-100 flex justify-end gap-3 bg-slate-50/50">
                <button type="button" id="cropper-cancel" class="px-5 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 font-medium text-sm">
                    Batal
                </button>
                <button type="button" id="cropper-crop" class="px-5 py-2 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700 font-medium text-sm">
                    Potong & Simpan
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('input[type="file"][data-crop-ratio]');
            if (inputs.length === 0) return;

            const modal = document.getElementById('cropper-modal');
            const img = document.getElementById('cropper-image');
            const closeBtn = document.getElementById('cropper-close');
            const cancelBtn = document.getElementById('cropper-cancel');
            const cropBtn = document.getElementById('cropper-crop');

            let cropper = null;
            let currentInput = null;
            let currentFile = null;

            inputs.forEach(input => {
                input.addEventListener('change', (e) => {
                    const files = e.target.files;
                    if (!files || files.length === 0) return;

                    const file = files[0];
                    if (!file.type.startsWith('image/')) return;

                    // If it is already our cropped blob/file, don't re-crop
                    if (file.isCropped) return;

                    currentInput = e.target;
                    currentFile = file;

                    const reader = new FileReader();
                    reader.onload = (event) => {
                        img.src = event.target.result;
                        modal.classList.remove('hidden');

                        const ratio = parseFloat(currentInput.getAttribute('data-crop-ratio')) || NaN;

                        if (cropper) {
                            cropper.destroy();
                        }

                        cropper = new Cropper(img, {
                            aspectRatio: isNaN(ratio) ? null : ratio,
                            viewMode: 1,
                            autoCropArea: 0.9,
                            responsive: true,
                            restore: false,
                        });
                    };
                    reader.readAsDataURL(file);
                });
            });

            function closeModal() {
                modal.classList.add('hidden');
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
                if (currentInput && !currentInput.files[0]?.isCropped) {
                    currentInput.value = ''; // Reset input if cancelled
                }
            }

            closeBtn.addEventListener('click', closeModal);
            cancelBtn.addEventListener('click', closeModal);

            cropBtn.addEventListener('click', () => {
                if (!cropper) return;

                cropper.getCroppedCanvas({
                    maxWidth: 1600,
                    maxHeight: 1600,
                    imageSmoothingQuality: 'high'
                }).toBlob((blob) => {
                    if (!blob) return;

                    const croppedFile = new File([blob], currentFile.name, {
                        type: currentFile.type,
                        lastModified: Date.now()
                    });
                    croppedFile.isCropped = true; // Mark as cropped to prevent infinite loop

                    // Replace input files using DataTransfer
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(croppedFile);
                    currentInput.files = dataTransfer.files;

                    // Trigger live preview update if applicable
                    currentInput.dispatchEvent(new Event('input', { bubbles: true }));
                    currentInput.dispatchEvent(new Event('change', { bubbles: true }));

                    // Trigger image link preview if page has one (e.g. Project Form preview)
                    const previewImgEl = document.getElementById('preview-img-el') || document.querySelector('#project-preview img') || document.querySelector('#preview-image img');
                    const previewContainer = document.getElementById('preview-image') || document.getElementById('preview-image-container');
                    
                    if (previewImgEl) {
                        previewImgEl.src = URL.createObjectURL(blob);
                    } else if (previewContainer) {
                        previewContainer.innerHTML = `<img src="${URL.createObjectURL(blob)}" class="w-full h-full object-cover rounded-xl" />`;
                    }

                    // For profile picture edit page, update the circular preview
                    const profileAvatarPreview = document.querySelector('.flex.items-center.gap-4 img');
                    if (profileAvatarPreview) {
                        profileAvatarPreview.src = URL.createObjectURL(blob);
                    }

                    closeModal();
                }, currentFile.type);
            });
        });
    </script>
</body>
</html>
