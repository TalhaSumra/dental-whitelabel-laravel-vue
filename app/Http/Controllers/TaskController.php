<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Support\ClientScope;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function store(Request $request, Project $project): RedirectResponse
    {
        abort_unless($request->user()->isInternal(), 403);

        $data = $request->validate([
            'assigned_to_user_id' => ['nullable', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'status' => ['required', Rule::in(['todo', 'doing', 'review', 'done', 'blocked'])],
            'visibility' => ['required', Rule::in(['internal', 'client_visible'])],
            'due_date' => ['nullable', 'date'],
        ]);

        $project->tasks()->create($data);

        return back()->with('success', 'Task created.');
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        abort_unless(ClientScope::canAccessProject($request->user(), $task->project), 403);

        $rules = [
            'status' => ['required', Rule::in(['todo', 'doing', 'review', 'done', 'blocked'])],
        ];

        if ($request->user()->isInternal()) {
            $rules += [
                'title' => ['sometimes', 'required', 'string', 'max:255'],
                'description' => ['nullable', 'string', 'max:5000'],
                'visibility' => ['sometimes', 'required', Rule::in(['internal', 'client_visible'])],
                'due_date' => ['nullable', 'date'],
            ];
        }

        $task->update($request->validate($rules));

        return back()->with('success', 'Task updated.');
    }
}
