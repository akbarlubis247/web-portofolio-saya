{{-- Form proyek sederhana + live preview --}}
@php
    $project = $project ?? null;
    $rawImage = $project ? $project->getRawOriginal('image_url') : null;
    $imageLink = old('image_link', ($rawImage && str_starts_with($rawImage, 'http')) ? $rawImage : '');
@endphp

<div class="grid lg:grid-cols-2 gap-6">
    {{-- Form --}}
    <div class="space-y-5" id="project-form">
        <div class="admin-card p-6 space-y-4">
            <h3 class="font-semibold text-slate-900">🏷️ Informasi Proyek</h3>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Title Project *</label>
                <input type="text" name="title" id="field-title" value="{{ old('title', $project?->title) }}" required
                       placeholder="Contoh: Sales Data Analysis"
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">📅 Tanggal Proyek</label>
                <input type="date" name="project_date" id="field-date"
                       value="{{ old('project_date', $project?->project_date?->format('Y-m-d') ?? date('Y-m-d')) }}"
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">📝 Description *</label>
                <textarea name="description" id="field-description" rows="3" required
                          placeholder="Jelaskan proyek secara singkat..."
                          class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">{{ old('description', $project?->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">🎯 Problem Statement</label>
                <textarea name="problem" id="field-problem" rows="3"
                          placeholder="Masalah apa yang diselesaikan proyek ini?"
                          class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">{{ old('problem', $project?->problem) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">📊 Insight / Result * <span class="text-cyan-600">(HR cari ini!)</span></label>
                <textarea name="insight" id="field-insight" rows="4"
                          placeholder="Tulis insight utama, angka, dan hasil analisis..."
                          class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">{{ old('insight', $project?->insight) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">🛠️ Tools <span class="text-slate-400 font-normal">(pisahkan dengan koma)</span></label>
                <input type="text" name="tools" id="field-tools"
                       value="{{ old('tools', $project ? implode(', ', $project->tools ?? []) : '') }}"
                       placeholder="Python, SQL, Power BI"
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
                <p class="text-xs text-slate-400 mt-1">Otomatis dipisah per koma saat disimpan</p>
            </div>
        </div>

        <div class="admin-card p-6 space-y-4">
            <h3 class="font-semibold text-slate-900">🔗 Link & Gambar</h3>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">🖼️ Upload Gambar / Bukti Proyek</label>
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
                <label class="block text-sm font-medium text-slate-700 mb-1">🖼️ Atau Link Gambar</label>
                <input type="url" name="image_link" id="field-image-link" value="{{ $imageLink }}"
                       placeholder="https://..."
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
            </div>

            @if($project?->image_url)
                <div class="flex items-center gap-3">
                    <img src="{{ $project->image_url }}" alt="" id="current-image" class="h-20 w-auto max-w-[160px] rounded object-contain border p-1 bg-white">
                    <span class="text-xs text-slate-400">Gambar yang digunakan saat ini</span>
                </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">🔗 GitHub Link</label>
                <input type="url" name="github_link" id="field-github"
                       value="{{ old('github_link', $project?->github_link) }}"
                       placeholder="https://github.com/akbarlubis247/repo"
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">🌐 Live Demo <span class="text-slate-400 font-normal">(opsional)</span></label>
                <input type="url" name="demo_link" id="field-demo"
                       value="{{ old('demo_link', $project?->demo_link) }}"
                       placeholder="https://..."
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
            </div>
        </div>
    </div>

    {{-- Live Preview (Editorial Theme Matching Frontend) --}}
    <div class="lg:sticky lg:top-6 h-fit">
        <div class="admin-card p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-slate-900">👁️ Live Preview Card</h3>
                <span class="text-[11px] font-mono uppercase tracking-wider text-[#467C78] font-bold">Homepage Style</span>
            </div>
            <div id="project-preview" class="bg-[#F6F1E7] rounded-2xl overflow-hidden border border-[#D7D8D1] shadow-md">
                <div id="preview-image" class="aspect-[16/10] bg-[#E8E4DA] relative overflow-hidden flex items-center justify-center border-b border-[#D7D8D1]/80">
                    @if($project?->image_url)
                        <img src="{{ $project->image_url }}" class="w-full h-full object-contain p-1" alt="">
                    @else
                        <div class="w-full h-full bg-[#1D2A35] p-6 flex flex-col justify-between text-white">
                            <span class="text-[10px] font-mono uppercase tracking-widest text-[#D5B98C]">[ DATA ANALYTICS ]</span>
                            <span class="text-xs text-[#D7D8D1] font-mono">Upload / cantumkan gambar proyek</span>
                        </div>
                    @endif
                </div>
                <div class="p-6">
                    <p id="preview-date" class="font-mono text-xs text-[#467C78] font-bold mb-2 uppercase tracking-widest">{{ $project?->project_date?->format('M Y') ?? date('M Y') }}</p>
                    <h4 id="preview-title" class="text-xl font-bold text-[#1D2A35] mb-2 leading-snug">{{ $project?->title ?? 'Judul Proyek' }}</h4>
                    <p id="preview-description" class="text-sm text-[#1D2A35]/75 mb-4 leading-relaxed">{{ $project?->description ?? 'Deskripsi proyek akan muncul di sini...' }}</p>
                    <div id="preview-tools" class="flex flex-wrap gap-1.5 mb-4">
                        @if($project?->tools)
                            @foreach($project->tools as $tool)
                                <span class="text-[11px] font-mono font-medium px-2.5 py-0.5 rounded-full bg-[#1D2A35]/5 text-[#1D2A35] border border-[#1D2A35]/10">{{ $tool }}</span>
                            @endforeach
                        @endif
                    </div>
                    <div class="border-t border-[#D7D8D1] pt-4 mt-2 space-y-2">
                        <div>
                            <p class="text-[11px] font-mono uppercase tracking-wider text-[#467C78] font-bold">🎯 Problem Statement</p>
                            <p id="preview-problem" class="text-xs text-[#1D2A35]/70 mt-0.5 leading-relaxed">{{ $project?->problem ?? '-' }}</p>
                        </div>
                        <div class="pt-2">
                            <p class="text-[11px] font-mono uppercase tracking-wider text-[#D5B98C] font-bold">📊 Insight / Result</p>
                            <p id="preview-insight" class="text-xs text-[#1D2A35]/80 mt-0.5 leading-relaxed whitespace-pre-line">{{ $project?->insight ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-xs text-slate-400 mt-3 text-center">Preview merepresentasikan tampilan kartu di website publik</p>
        </div>
    </div>
</div>

@vite(['resources/js/admin.js'])
