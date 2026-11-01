<?php

namespace App\Http\Controllers;

use App\Models\PortfolioSetting;
use App\Models\Project;

class PortfolioController extends Controller
{
    public function index()
    {
        $settings = PortfolioSetting::current();
        $projects = Project::published()->ordered()->get();
        $skills = $settings->skills ?: $this->defaultSkills();
        $certifications = \App\Models\Certification::published()->ordered()->get();

        return response()
            ->view('portfolio.index', compact('settings', 'projects', 'skills', 'certifications'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function showProject(Project $project)
    {
        if (! $project->is_published && ! auth()->check()) {
            abort(404);
        }

        $settings = PortfolioSetting::current();

        return view('portfolio.project', compact('project', 'settings'));
    }

    private function defaultSkills(): array
    {
        return [
            ['name' => 'Python', 'detail' => 'Pandas, NumPy', 'icon' => 'python'],
            ['name' => 'SQL', 'detail' => 'Query & Database', 'icon' => 'database'],
            ['name' => 'Excel', 'detail' => 'Spreadsheet Analysis', 'icon' => 'table'],
            ['name' => 'Data Visualization', 'detail' => 'Power BI', 'icon' => 'chart'],
            ['name' => 'Statistics', 'detail' => 'Hypothesis Testing', 'icon' => 'stats'],
        ];
    }
}
