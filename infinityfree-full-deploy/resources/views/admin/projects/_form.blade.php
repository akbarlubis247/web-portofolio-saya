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
                <label class="block text-sm font-medium text-slate-700 mb-1">🖼️ Upload Gambar</label>
                <input type="file" name="image" id="field-image" accept="image/*" data-crop-ratio="1.777"
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm cursor-pointer">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">🖼️ Atau Link Gambar</label>
                <input type="url" name="image_link" id="field-image-link" value="{{ $imageLink }}"
                       placeholder="https://..."
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
            </div>

            @if($project?->image_url)
                <img src="{{ $project->image_url }}" alt="" id="current-image" class="h-24 rounded object-cover border">
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

    {{-- Live Preview --}}
    <div class="lg:sticky lg:top-6 h-fit">
        <div class="admin-card p-6">
            <h3 class="font-semibold text-slate-900 mb-4">👁️ Preview</h3>
            <div id="project-preview" class="bg-slate-900 rounded-xl overflow-hidden border border-slate-700">
                <div id="preview-image" class="aspect-video img-placeholder">
                    @if($project?->image_url)
                        <img src="{{ $project->image_url }}" class="w-full h-full object-cover" alt="">
                    @else
                        <span class="text-slate-500 text-sm">Preview gambar</span>
                    @endif
                </div>
                <div class="p-5">
                    <p id="preview-date" class="text-xs text-cyan-400 mb-1">{{ $project?->project_date?->format('d M Y') ?? date('d M Y') }}</p>
                    <h4 id="preview-title" class="text-lg font-bold text-white mb-2">{{ $project?->title ?? 'Judul Proyek' }}</h4>
                    <p id="preview-description" class="text-sm text-slate-400 mb-3">{{ $project?->description ?? 'Deskripsi proyek akan muncul di sini...' }}</p>
                    <div id="preview-tools" class="flex flex-wrap gap-1 mb-3">
                        @if($project?->tools)
                            @foreach($project->tools as $tool)
                                <span class="text-xs px-2 py-0.5 rounded-full bg-cyan-500/10 text-cyan-400">{{ $tool }}</span>
                            @endforeach
                        @endif
                    </div>
                    <div class="border-t border-slate-700 pt-3 mt-3">
                        <p class="text-xs text-violet-400 font-medium mb-1">🎯 Problem</p>
                        <p id="preview-problem" class="text-xs text-slate-400 mb-3">{{ $project?->problem ?? '-' }}</p>
                        <p class="text-xs text-cyan-400 font-medium mb-1">📊 Insight / Result</p>
                        <p id="preview-insight" class="text-xs text-slate-300 whitespace-pre-line">{{ $project?->insight ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <p class="text-xs text-slate-400 mt-3 text-center">Preview diperbarui otomatis saat Anda mengetik</p>
        </div>
    </div>
</div>

@vite(['resources/js/admin.js'])
