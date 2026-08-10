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
                <label class="block text-sm font-medium text-slate-700 mb-1">Upload Gambar / Logo</label>
                <input type="file" name="image" id="field-image" accept="image/*" data-crop-ratio="1"
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm cursor-pointer">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Atau Link Gambar</label>
                <input type="url" name="image_link" id="field-image-link" value="{{ $imageLink }}"
                       placeholder="https://..."
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
            </div>

            @if($certification?->image_url)
                <div class="flex items-center gap-3">
                    <img src="{{ $certification->image_url }}" alt="" id="current-image" class="h-16 w-16 rounded object-cover border">
                    <span class="text-xs text-slate-400">Gambar yang digunakan saat ini</span>
                </div>
            @endif
        </div>
    </div>

    {{-- Live Preview --}}
    <div class="lg:sticky lg:top-6 h-fit">
        <div class="admin-card p-6">
            <h3 class="font-semibold text-slate-900 mb-4">👁️ Preview Card (Homepage)</h3>
            <div id="cert-preview" class="bg-white border border-slate-100 rounded-2xl p-6 flex items-start gap-4 shadow-sm">
                <div id="preview-image" class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0 text-blue-600 border border-blue-100/30">
                    @if($certification?->image_url)
                        <img src="{{ $certification->image_url }}" class="w-full h-full object-cover rounded-xl" alt="" id="preview-img-el">
                    @else
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="preview-svg-el">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <h4 id="preview-title" class="font-bold text-slate-800 mb-1 text-base truncate">{{ $certification?->title ?? 'Nama Sertifikasi' }}</h4>
                    <p id="preview-issuer" class="text-sm font-semibold text-blue-600 mb-2">{{ $certification?->issuer ?? 'Penerbit Organisasi' }}</p>
                    <p id="preview-date" class="text-xs text-slate-400">
                        @if($certification?->issue_date)
                            Terkait: {{ $certification->issue_date->format('M Y') }}
                        @else
                            Terkait: -
                        @endif
                    </p>
                </div>
            </div>
            <p class="text-xs text-slate-400 mt-4 text-center">Preview merepresentasikan tampilan di website publik</p>
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

        if (fieldImageLink) {
            fieldImageLink.addEventListener('input', () => {
                const val = fieldImageLink.value;
                if (val && (val.startsWith('http://') || val.startsWith('https://'))) {
                    previewImage.innerHTML = `<img src="${val}" class="w-full h-full object-cover rounded-xl" />`;
                } else {
                    const currentImg = document.getElementById('current-image');
                    if (currentImg) {
                        previewImage.innerHTML = `<img src="${currentImg.src}" class="w-full h-full object-cover rounded-xl" />`;
                    } else {
                        previewImage.innerHTML = `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>`;
                    }
                }
            });
        }
    });
</script>
