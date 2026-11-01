@php
    $certification = $certification ?? null;
    $rawImage = $certification ? $certification->getRawOriginal('image_url') : null;
    $imageLink = old('image_link', ($rawImage && str_starts_with($rawImage, 'http')) ? $rawImage : '');
@endphp

<div class="grid lg:grid-cols-2 gap-6">
    {{-- Form --}}
    <div class="space-y-5" id="cert-form">
        <div class="admin-card p-6 space-y-4">
            <h3 class="font-semibold text-slate-900">🏷️ Informasi Sertifikasi</h3>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Sertifikasi / Lisensi *</label>
                <input type="text" name="title" id="field-title" value="{{ old('title', $certification?->title) }}" required
                       placeholder="Contoh: Google Data Analytics Professional Certificate"
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Penerbit / Organisasi *</label>
                <input type="text" name="issuer" id="field-issuer" value="{{ old('issuer', $certification?->issuer) }}" required
                       placeholder="Contoh: Coursera, Google, Microsoft"
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">📅 Tanggal Terbit</label>
                    <input type="date" name="issue_date" id="field-issue-date"
                           value="{{ old('issue_date', $certification?->issue_date?->format('Y-m-d')) }}"
                           class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">📅 Tanggal Kedaluwarsa</label>
                    <input type="date" name="expiration_date" id="field-expiration-date"
                           value="{{ old('expiration_date', $certification?->expiration_date?->format('Y-m-d')) }}"
                           class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
                    <p class="text-xs text-slate-400 mt-1">Kosongkan jika tidak kedaluwarsa</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Credential ID</label>
                    <input type="text" name="credential_id" id="field-credential-id"
                           value="{{ old('credential_id', $certification?->credential_id) }}"
                           placeholder="Contoh: GCC1234567"
                           class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Credential URL</label>
                    <input type="url" name="credential_url" id="field-credential-url"
                           value="{{ old('credential_url', $certification?->credential_url) }}"
                           placeholder="https://..."
                           class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
                </div>
            </div>
        </div>

        <div class="admin-card p-6 space-y-4">
            <h3 class="font-semibold text-slate-900">🖼️ Gambar / Logo Sertifikasi</h3>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Upload Gambar / Sertifikat Penuh</label>
                <input type="file" name="image" id="field-image" accept="image/*"
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm cursor-pointer">
                <div class="flex flex-wrap items-center justify-between gap-2 mt-1.5">
                    <p class="text-xs text-slate-500">
                        ⚡ <strong>Otomatis 100% Penuh:</strong> Gambar langsung diunggah utuh tanpa perlu atur-atur posisi lagi.
                    </p>
                    <button type="button" id="btn-adjust-image" class="hidden text-xs text-cyan-600 hover:text-cyan-800 font-semibold items-center gap-1 cursor-pointer bg-cyan-50 hover:bg-cyan-100 px-2.5 py-1 rounded-md border border-cyan-200 transition-colors">
                        ✂️ Sesuaikan / Potong Posisi (Opsional)
                    </button>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Atau Link Gambar</label>
                <input type="url" name="image_link" id="field-image-link" value="{{ $imageLink }}"
                       placeholder="https://..."
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
            </div>

            @if($certification?->image_url)
                <div class="flex items-center gap-3">
                    <img src="{{ $certification->image_url }}" alt="" id="current-image" class="h-16 w-auto max-w-[120px] rounded object-contain border p-1 bg-white">
                    <span class="text-xs text-slate-400">Gambar yang digunakan saat ini</span>
                </div>
            @endif
        </div>
    </div>

    {{-- Live Preview (Editorial Theme Matching Frontend) --}}
    <div class="lg:sticky lg:top-6 h-fit space-y-4">
        <div class="admin-card p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-slate-900">👁️ Live Preview Card</h3>
                <span class="text-[11px] font-mono uppercase tracking-wider text-[#467C78] font-bold">Homepage Style</span>
            </div>
            <div id="cert-preview" class="bg-[#F6F1E7] border border-[#D7D8D1] rounded-2xl p-6 flex items-start gap-4 shadow-sm">
                <div id="preview-image" class="w-14 h-14 rounded-xl bg-[#1D2A35] p-2 flex items-center justify-center flex-shrink-0 text-[#D5B98C] border border-[#D7D8D1]/40 overflow-hidden shadow-xs">
                    @if($certification?->image_url)
                        <img src="{{ $certification->image_url }}" class="w-full h-full object-contain rounded-lg" alt="" id="preview-img-el">
                    @else
                        <svg class="w-6 h-6 text-[#D5B98C]" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="preview-svg-el">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <h4 id="preview-title" class="font-bold text-[#1D2A35] mb-1 text-base truncate">{{ $certification?->title ?? 'Nama Sertifikasi' }}</h4>
                    <p id="preview-issuer" class="font-mono text-xs font-semibold text-[#467C78] mb-1.5 uppercase tracking-wider">{{ $certification?->issuer ?? 'Penerbit Organisasi' }}</p>
                    <p id="preview-date" class="text-xs text-[#1D2A35]/60 mb-2">
                        @if($certification?->issue_date)
                            Terbit: {{ $certification->issue_date->format('M Y') }}
                        @else
                            Terbit: -
                        @endif
                    </p>
                    <div class="inline-flex items-center gap-1.5 text-[11px] font-mono font-bold text-[#1D2A35] uppercase tracking-wider">
                        🔍 Lihat Detail &amp; Kredensial &rarr;
                    </div>
                </div>
            </div>

            {{-- Full Certificate Preview to assure user nothing is cut off --}}
            <div id="cert-full-preview" class="mt-4 p-3 bg-white rounded-xl border border-slate-200 {{ $certification?->image_url ? '' : 'hidden' }}">
                <p class="text-xs font-semibold text-slate-700 mb-2 flex items-center gap-1.5">
                    <span>📄</span> Tampilan Penuh Gambar (Tidak Ada yang Terpotong):
                </p>
                <div class="rounded-lg overflow-hidden border border-slate-100 bg-slate-50 flex items-center justify-center p-2">
                    <img id="cert-full-preview-img" src="{{ $certification?->image_url ?? '' }}" alt="Sertifikat Penuh" class="max-h-56 max-w-full object-contain rounded">
                </div>
            </div>

            <p class="text-xs text-slate-400 mt-4 text-center">Preview merepresentasikan tampilan kartu di website publik</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const fieldTitle = document.getElementById('field-title');
        const fieldIssuer = document.getElementById('field-issuer');
        const fieldIssueDate = document.getElementById('field-issue-date');
        
        const previewTitle = document.getElementById('preview-title');
        const previewIssuer = document.getElementById('preview-issuer');
        const previewDate = document.getElementById('preview-date');
        const previewImage = document.getElementById('preview-image');
        const fieldImageLink = document.getElementById('field-image-link');
        const fieldImage = document.getElementById('field-image');
        const certFullPreview = document.getElementById('cert-full-preview');
        const certFullPreviewImg = document.getElementById('cert-full-preview-img');

        function updatePreview() {
            if (previewTitle && fieldTitle) previewTitle.textContent = fieldTitle.value || 'Nama Sertifikasi';
            if (previewIssuer && fieldIssuer) previewIssuer.textContent = fieldIssuer.value || 'Penerbit Organisasi';
            
            if (previewDate && fieldIssueDate && fieldIssueDate.value) {
                const date = new Date(fieldIssueDate.value);
                const options = { year: 'numeric', month: 'short' };
                previewDate.textContent = 'Terkait: ' + date.toLocaleDateString('id-ID', options);
            } else if (previewDate) {
                previewDate.textContent = 'Terkait: -';
            }
        }

        if (fieldTitle) fieldTitle.addEventListener('input', updatePreview);
        if (fieldIssuer) fieldIssuer.addEventListener('input', updatePreview);
        if (fieldIssueDate) fieldIssueDate.addEventListener('change', updatePreview);

        function setPreviewImageSource(url) {
            if (url) {
                if (previewImage) {
                    previewImage.innerHTML = `<img src="${url}" class="w-full h-full object-contain rounded-lg" alt="" id="preview-img-el">`;
                }
                if (certFullPreview && certFullPreviewImg) {
                    certFullPreviewImg.src = url;
                    certFullPreview.classList.remove('hidden');
                }
            } else {
                const currentImg = document.getElementById('current-image');
                if (currentImg && previewImage) {
                    previewImage.innerHTML = `<img src="${currentImg.src}" class="w-full h-full object-contain rounded-lg" alt="" id="preview-img-el">`;
                    if (certFullPreview && certFullPreviewImg) {
                        certFullPreviewImg.src = currentImg.src;
                        certFullPreview.classList.remove('hidden');
                    }
                } else {
                    if (previewImage) {
                        previewImage.innerHTML = `<svg class="w-6 h-6 text-[#D5B98C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>`;
                    }
                    if (certFullPreview) certFullPreview.classList.add('hidden');
                }
            }
        }

        const adjustBtn = document.getElementById('btn-adjust-image');

        if (fieldImage) {
            fieldImage.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (ev) => {
                        setPreviewImageSource(ev.target.result);
                    };
                    reader.readAsDataURL(file);
                    if (adjustBtn) {
                        adjustBtn.classList.remove('hidden');
                        adjustBtn.classList.add('inline-flex');
                    }
                } else if (adjustBtn) {
                    adjustBtn.classList.add('hidden');
                    adjustBtn.classList.remove('inline-flex');
                }
            });

            if (adjustBtn) {
                adjustBtn.addEventListener('click', () => {
                    if (window.openCropper) {
                        window.openCropper(fieldImage);
                    }
                });
            }
        }

        if (fieldImageLink) {
            fieldImageLink.addEventListener('input', () => {
                const val = fieldImageLink.value.trim();
                if (val && (val.startsWith('http://') || val.startsWith('https://'))) {
                    setPreviewImageSource(val);
                } else if (!fieldImage || !fieldImage.files.length) {
                    setPreviewImageSource(null);
                }
            });
        }
    });
</script>
