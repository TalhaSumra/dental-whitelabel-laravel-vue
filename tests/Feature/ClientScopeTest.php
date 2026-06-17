<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientScopeTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_user_cannot_open_another_clients_project(): void
    {
        $clientA = Client::factory()->create();
        $clientB = Client::factory()->create();

        $user = User::factory()->create([
            'role' => UserRole::CLIENT,
            'client_id' => $clientA->id,
        ]);

        $project = Project::factory()->create([
            'client_id' => $clientB->id,
        ]);

        $this->actingAs($user)->get(route('projects.show', $project))->assertForbidden();
    }

    public function test_agency_admin_can_open_any_project(): void
    {
        $client = Client::factory()->create();
        $user = User::factory()->create([
            'role' => UserRole::AGENCY_ADMIN,
        ]);
        $project = Project::factory()->create([
            'client_id' => $client->id,
        ]);

        $this->actingAs($user)->get(route('projects.show', $project))->assertOk();
    }
}
