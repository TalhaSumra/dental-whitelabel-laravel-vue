<?php

namespace App\Http\Controllers;

use App\Models\AgencySetting;
use App\Models\Client;
use App\Models\MonthlyReport;
use App\Support\ClientScope;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class MonthlyReportController extends Controller
{
    public function store(Request $request, Client $client): RedirectResponse
    {
        abort_unless($request->user()->isInternal(), 403);

        $data = $request->validate([
            'project_id' => ['nullable', 'exists:projects,id'],
            'month' => ['required', 'integer', 'between:1,12'],
            'year' => ['required', 'integer', 'between:2024,2100'],
            'summary' => ['nullable', 'string', 'max:5000'],
            'metrics' => ['nullable', 'array'],
            'completed_work' => ['nullable', 'array'],
            'next_month_plan' => ['nullable', 'array'],
        ]);

        $report = MonthlyReport::create($data + [
            'client_id' => $client->id,
            'status' => 'draft',
        ]);

        return redirect()->route('reports.show', $report)->with('success', 'Report draft created.');
    }

    public function show(Request $request, MonthlyReport $report): Response
    {
        abort_unless(ClientScope::canAccessReport($request->user(), $report), 403);

        $report->load(['client', 'project']);

        return Inertia::render('Reports/Show', [
            'agency' => AgencySetting::current(),
            'report' => $report,
        ]);
    }

    public function update(Request $request, MonthlyReport $report): RedirectResponse
    {
        abort_unless($request->user()->isInternal(), 403);

        $data = $request->validate([
            'summary' => ['nullable', 'string', 'max:5000'],
            'metrics' => ['nullable', 'array'],
            'completed_work' => ['nullable', 'array'],
            'next_month_plan' => ['nullable', 'array'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        if ($data['status'] === 'published' && $report->status !== 'published') {
            $data['published_at'] = Carbon::now();
        }

        $report->update($data);

        return back()->with('success', 'Report updated.');
    }
}
