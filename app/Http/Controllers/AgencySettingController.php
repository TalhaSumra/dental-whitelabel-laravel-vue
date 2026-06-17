<?php

namespace App\Http\Controllers;

use App\Models\AgencySetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AgencySettingController extends Controller
{
    public function edit(): Response
    {
        return Inertia::render('Settings/Agency', [
            'agency' => AgencySetting::current(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        abort_unless($request->user()->role === 'agency_admin', 403);

        $data = $request->validate([
            'agency_name' => ['required', 'string', 'max:255'],
            'support_email' => ['nullable', 'email', 'max:255'],
            'support_phone' => ['nullable', 'string', 'max:50'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'brand_color' => ['required', 'string', 'max:20'],
            'client_report_footer' => ['nullable', 'string', 'max:3000'],
        ]);

        AgencySetting::current()->update($data);

        return back()->with('success', 'Agency settings updated.');
    }
}
