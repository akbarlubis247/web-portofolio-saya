/**
 * Live preview untuk form admin proyek
 */
document.addEventListener('DOMContentLoaded', () => {
    const fields = {
        title: document.getElementById('field-title'),
        description: document.getElementById('field-description'),
        problem: document.getElementById('field-problem'),
        insight: document.getElementById('field-insight'),
        tools: document.getElementById('field-tools'),
        date: document.getElementById('field-date'),
        imageLink: document.getElementById('field-image-link'),
        imageFile: document.getElementById('field-image'),
    };

    const preview = {
        title: document.getElementById('preview-title'),
        description: document.getElementById('preview-description'),
        problem: document.getElementById('preview-problem'),
        insight: document.getElementById('preview-insight'),
        tools: document.getElementById('preview-tools'),
        date: document.getElementById('preview-date'),
        image: document.getElementById('preview-image'),
    };

    if (!fields.title) return;

    function formatDate(value) {
        if (!value) return '-';
        const d = new Date(value + 'T00:00:00');
        return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
    }

    function renderTools(value) {
        if (!preview.tools) return;
        const tools = value.split(/[,;]+/).map((t) => t.trim()).filter(Boolean);
        preview.tools.innerHTML = tools.map((t) =>
            `<span class="text-xs px-2 py-0.5 rounded-full bg-cyan-500/10 text-cyan-400">${t}</span>`
        ).join('');
    }

    function updatePreview() {
        if (preview.title) preview.title.textContent = fields.title.value || 'Judul Proyek';
        if (preview.description) preview.description.textContent = fields.description.value || 'Deskripsi proyek akan muncul di sini...';
        if (preview.problem) preview.problem.textContent = fields.problem.value || '-';
        if (preview.insight) preview.insight.textContent = fields.insight.value || '-';
        if (preview.date) preview.date.textContent = formatDate(fields.date.value);
        renderTools(fields.tools.value);
    }

    Object.values(fields).forEach((el) => {
        if (el) el.addEventListener('input', updatePreview);
    });

    if (fields.imageLink) {
        fields.imageLink.addEventListener('input', () => {
            const url = fields.imageLink.value;
            if (url && preview.image) {
                preview.image.innerHTML = `<img src="${url}" class="w-full h-full object-cover" alt="" onerror="this.parentElement.innerHTML='<span class=\\'text-slate-500 text-sm\\'>Gambar tidak valid</span>'">`;
            }
        });
    }

    if (fields.imageFile) {
        fields.imageFile.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file && preview.image) {
                const reader = new FileReader();
                reader.onload = (ev) => {
                    preview.image.innerHTML = `<img src="${ev.target.result}" class="w-full h-full object-cover" alt="">`;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    updatePreview();
});
