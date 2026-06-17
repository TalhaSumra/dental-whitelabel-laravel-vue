<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\ServicePackage;
use App\Support\ClientScope;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function create(Client $client): Response
    {
        return Inertia::render('Projects/Create', [
            'client' => $client,
            'packages' => ServicePackage::where('is_active', true)->get(),
        ]);
    }

    public function store(Request $request, Client $client): RedirectResponse
    {
        $data = $request->validate([
            'service_package_id' => ['nullable', 'exists:service_packages,id'],
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(['website', 'seo', 'gbp', 'ads', 'content', 'bundle'])],
            'status' => ['required', Rule::in(['not_started', 'in_progress', 'waiting_client', 'completed', 'paused', 'cancelled'])],
            'start_date' => ['nullable', 'date'],
            'due_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'client_price_cad' => ['required', 'integer', 'min:0'],
            'white_label_cost_cad' => ['required', 'integer', 'min:0'],
            'scope' => ['nullable', 'string', 'max:5000'],
        ]);

        $data['client_id'] = $client->id;
        $data['owner_user_id'] = $request->user()->id;

        $project = Project::create($data);

        return redirect()->route('projects.show', $project)->with('success', 'Project created.');
    }

    public function show(Request $request, Project $project): Response
    {
        abort_unless(ClientScope::canAccessProject($request->user(), $project), 403);

        $project->load(['client', 'tasks.assignedTo', 'deliverables']);

        $visibleProject = $project;
        if ($request->user()->isClient()) {
            $visibleProject->setRelation('tasks', $project->tasks->where('visibility', 'client_visible')->values());
            $visibleProject->setRelation('deliverables', $project->deliverables->where('is_client_visible', true)->values());
            $visibleProject->makeHidden(['white_label_cost_cad', 'internal_notes']);
        }

        return Inertia::render('Projects/Show', [
            'project' => $visibleProject,
        ]);
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        abort_unless($request->user()->canManageClients(), 403);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in(['not_started', 'in_progress', 'waiting_client', 'completed', 'paused', 'cancelled'])],
            'start_date' => ['nullable', 'date'],
            'due_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'client_price_cad' => ['required', 'integer', 'min:0'],
            'white_label_cost_cad' => ['required', 'integer', 'min:0'],
            'scope' => ['nullable', 'string', 'max:5000'],
        ]);

        $project->update($data);

        return back()->with('success', 'Project updated.');
    }
}
