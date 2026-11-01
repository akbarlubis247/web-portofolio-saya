<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\PortfolioSetting;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $projectCount = Project::count();
        $publishedCount = Project::where('is_published', true)->count();
        $recentProjects = Project::ordered()->take(5)->get();

        $certificationCount = Certification::count();
        $publishedCertCount = Certification::where('is_published', true)->count();
        $recentCertifications = Certification::ordered()->take(5)->get();

        $settings = PortfolioSetting::current();

        return view('admin.dashboard', compact(
            'projectCount',
            'publishedCount',
            'recentProjects',
            'certificationCount',
            'publishedCertCount',
            'recentCertifications',
            'settings'
        ));
    }
}
