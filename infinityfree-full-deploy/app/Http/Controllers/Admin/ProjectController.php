<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
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

    public function store(Request $request)
    {
        $data = $this->validateProject($request);
        $data['tools'] = $this->parseTools($request->input('tools'));
        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['is_published'] = $request->input('action') !== 'draft';

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('projects', 'public');
        } elseif ($request->filled('image_link')) {
            $data['image_url'] = $request->input('image_link');
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

    public function update(Request $request, Project $project)
    {
        $data = $this->validateProject($request);
        $data['tools'] = $this->parseTools($request->input('tools'));
        $data['is_published'] = $request->input('action') !== 'draft';

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('projects', 'public');
        } elseif ($request->filled('image_link')) {
            $data['image_url'] = $request->input('image_link');
        }

        if ($project->title !== $data['title']) {
            $data['slug'] = $this->uniqueSlug($data['title'], $project->id);
        }

        $project->update($data);

        $message = $data['is_published']
            ? 'Proyek berhasil diperbarui.'
            : 'Draft proyek berhasil disimpan.';

        return redirect()->route('admin.projects.index')->with('success', $message);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyek berhasil dihapus.');
    }

    private function validateProject(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'problem' => ['nullable', 'string'],
            'insight' => ['nullable', 'string'],
            'tools' => ['nullable', 'string'],
            'image_link' => ['nullable', 'url'],
            'image' => ['nullable', 'image', 'max:2048'],
            'github_link' => ['nullable', 'url'],
            'demo_link' => ['nullable', 'url'],
            'project_date' => ['nullable', 'date'],
        ]);
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
