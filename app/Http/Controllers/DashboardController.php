<?php

namespace App\Http\Controllers;

use App\Models\AgencySetting;
use App\Models\AuditLead;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $user = $request->user();

        if ($user->isClient()) {
            $projects = Project::query()
                ->where('client_id', $user->client_id)
                ->withCount(['tasks', 'deliverables'])
                ->latest()
                ->get();

            return Inertia::render('Dashboard', [
                'agency' => AgencySetting::current(),
                'mode' => 'client',
                'stats' => [
                    'projects' => $projects->count(),
                    'active_projects' => $projects->whereNotIn('status', ['completed', 'cancelled'])->count(),
                ],
                'projects' => $projects,
            ]);
        }

        return Inertia::render('Dashboard', [
            'agency' => AgencySetting::current(),
            'mode' => 'internal',
            'stats' => [
                'clients' => Client::count(),
                'active_projects' => Project::whereNotIn('status', ['completed', 'cancelled'])->count(),
                'new_audit_leads' => AuditLead::where('status', 'new')->count(),
                'monthly_margin_cad' => Project::whereNotIn('status', ['cancelled'])->get()->sum->grossMarginCad(),
            ],
            'projects' => Project::query()->with('client')->latest()->limit(8)->get(),
        ]);
    }
}
