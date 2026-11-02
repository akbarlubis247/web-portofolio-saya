<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Services\SupabaseMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::ordered()->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request, SupabaseMedia $media)
    {
        $data = $this->validateProject($request);
        $data['tools'] = $this->parseTools($request->input('tools'));
        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['is_published'] = $request->input('action') !== 'draft';
        $data['github_link'] = $this->normalizeUrl($request->input('github_link'));
        $data['demo_link'] = $this->normalizeUrl($request->input('demo_link'));

        if ($request->hasFile('image')) {
            $data['image_url'] = $media->upload($request->file('image'), 'projects');
        } elseif ($request->filled('image_link')) {
            $data['image_url'] = $this->normalizeUrl($request->input('image_link'));
        }

        Project::create($data);

        $message = $data['is_published']
            ? 'Proyek berhasil dipublikasikan.'
            : 'Draft proyek berhasil disimpan.';

        return redirect()->route('admin.projects.index')->with('success', $message);
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project, SupabaseMedia $media)
    {
        $data = $this->validateProject($request);
        $data['tools'] = $this->parseTools($request->input('tools'));
        $data['is_published'] = $request->input('action') !== 'draft';
        $data['github_link'] = $this->normalizeUrl($request->input('github_link'));
        $data['demo_link'] = $this->normalizeUrl($request->input('demo_link'));

        if ($request->hasFile('image')) {
            $media->delete($project->getRawOriginal('image_url'));
            $data['image_url'] = $media->upload($request->file('image'), 'projects');
        } elseif ($request->filled('image_link')) {
            $data['image_url'] = $this->normalizeUrl($request->input('image_link'));
        }

        if ($project->title !== $data['title']) {
            $data['slug'] = $this->uniqueSlug($data['title'], $project->id);
        }

        $project->update($data);

        $message = $data['is_published']
            ? 'Proyek berhasil diperbarui dan dipublikasikan.'
            : 'Draft proyek berhasil disimpan.';

        return redirect()->route('admin.projects.index')->with('success', $message);
    }

    public function togglePublish(Project $project)
    {
        $project->is_published = ! $project->is_published;
        $project->save();

        $status = $project->is_published ? 'dipublikasikan ke website publik' : 'disembunyikan (draft)';
        return back()->with('success', "Proyek '{$project->title}' berhasil {$status}.");
    }

    public function destroy(Project $project, SupabaseMedia $media)
    {
        $media->delete($project->getRawOriginal('image_url'));

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyek berhasil dihapus dari sistem dan website publik.');
    }

    private function validateProject(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'problem' => ['nullable', 'string'],
            'insight' => ['nullable', 'string'],
            'tools' => ['nullable', 'string'],
            'image_link' => ['nullable', 'string', 'max:500'],
            'image' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,webp,bmp,heic,heif,jfif,avif', 'max:25600'],
            'github_link' => ['nullable', 'string', 'max:500'],
            'demo_link' => ['nullable', 'string', 'max:500'],
            'project_date' => ['nullable', 'date'],
        ]);
    }

    private function normalizeUrl(?string $url): ?string
    {
        if (! $url) {
            return null;
        }

        $url = trim($url);

        if (! str_starts_with($url, 'http://') && ! str_starts_with($url, 'https://')) {
            return 'https://'.$url;
        }

        return $url;
    }

    private function parseTools(?string $tools): array
    {
        if (! $tools) {
            return [];
        }

        return array_values(array_filter(array_map('trim', preg_split('/[,;]+/', $tools))));
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $counter = 1;

        while (
            Project::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original.'-'.$counter++;
        }

        return $slug;
    }
}
