<?php

namespace App\Http\Controllers;

use App\Models\AgencySetting;
use App\Models\AuditLead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AuditLeadController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Public/AuditRequest', [
            'agency' => AgencySetting::current(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        AuditLead::create($request->validate([
            'clinic_name' => ['required', 'string', 'max:255'],
            'contact_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'province' => ['nullable', 'string', 'max:100'],
            'message' => ['nullable', 'string', 'max:3000'],
        ]));

        return back()->with('success', 'Your audit request was received. We will contact you shortly.');
    }
}
