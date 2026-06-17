<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class ClientController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Clients/Index', [
            'clients' => Client::query()->latest()->paginate(15),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Clients/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'clinic_name' => ['required', 'string', 'max:255'],
            'contact_name' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'province' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:2000'],
            'services' => ['nullable', 'array'],
            'status' => ['required', Rule::in(['lead', 'active', 'paused', 'cancelled'])],
        ]);

        $data['slug'] = Str::slug($data['clinic_name']) . '-' . Str::lower(Str::random(5));

        $client = Client::create($data);

        return redirect()->route('clients.show', $client)->with('success', 'Client created.');
    }

    public function show(Client $client): Response
    {
        $client->load(['projects.tasks', 'reports' => fn ($query) => $query->latest()]);

        return Inertia::render('Clients/Show', [
            'client' => $client,
        ]);
    }

    public function update(Request $request, Client $client): RedirectResponse
    {
        $data = $request->validate([
            'clinic_name' => ['required', 'string', 'max:255'],
            'contact_name' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'province' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:2000'],
            'services' => ['nullable', 'array'],
            'status' => ['required', Rule::in(['lead', 'active', 'paused', 'cancelled'])],
        ]);

        $client->update($data);

        return back()->with('success', 'Client updated.');
    }
}
