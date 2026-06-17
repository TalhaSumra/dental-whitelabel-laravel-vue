<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\AgencySetting;
use App\Models\Client;
use App\Models\Project;
use App\Models\ServicePackage;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AgencyPortalSeeder extends Seeder
{
    public function run(): void
    {
        AgencySetting::firstOrCreate([], [
            'agency_name' => 'Dental Growth Media Canada',
            'support_email' => 'hello@dentalgrowth.local',
            'brand_color' => '#0f766e',
            'client_report_footer' => 'Prepared by Dental Growth Media Canada. All marketing claims require clinic approval before publishing.',
        ]);

        $admin = User::firstOrCreate([
            'email' => 'admin@dentalgrowth.local',
        ], [
            'name' => 'Talha Sumra',
            'password' => Hash::make('Password123!'),
            'role' => UserRole::AGENCY_ADMIN,
            'is_active' => true,
        ]);

        $packages = [
            [
                'name' => 'Dental Website + Local SEO Launch',
                'type' => 'bundle',
                'setup_price_cad' => 2500,
                'monthly_price_cad' => 1200,
                'deliverables' => ['7-page website', '4 service pages', 'GBP optimization', 'SEO setup', 'Monthly report'],
            ],
            [
                'name' => 'Local Dental SEO',
                'type' => 'seo',
                'setup_price_cad' => 0,
                'monthly_price_cad' => 1200,
                'deliverables' => ['Keyword research', 'On-page SEO', 'Local citations', 'GBP posts', 'Monthly report'],
            ],
            [
                'name' => 'Premium Dental Website',
                'type' => 'website',
                'setup_price_cad' => 4500,
                'monthly_price_cad' => 0,
                'deliverables' => ['10-page website', 'Copywriting', 'Conversion forms', 'Speed optimization', 'Analytics setup'],
            ],
        ];

        foreach ($packages as $package) {
            ServicePackage::firstOrCreate(['name' => $package['name']], $package);
        }

        $client = Client::firstOrCreate([
            'slug' => 'sample-toronto-dental-' . Str::lower(Str::random(4)),
        ], [
            'clinic_name' => 'Sample Toronto Dental Clinic',
            'contact_name' => 'Dr. Client',
            'contact_email' => 'client@example.com',
            'contact_phone' => '+1 555 000 0000',
            'website_url' => 'https://example.com',
            'city' => 'Toronto',
            'province' => 'Ontario',
            'status' => 'active',
            'services' => ['Emergency Dentist', 'Dental Implants', 'Invisalign', 'Teeth Whitening'],
        ]);

        User::firstOrCreate([
            'email' => 'client@example.com',
        ], [
            'name' => 'Clinic Client',
            'password' => Hash::make('Password123!'),
            'role' => UserRole::CLIENT,
            'client_id' => $client->id,
            'is_active' => true,
        ]);

        $project = Project::firstOrCreate([
            'client_id' => $client->id,
            'name' => 'Website + Local SEO Launch',
        ], [
            'service_package_id' => ServicePackage::where('type', 'bundle')->first()?->id,
            'owner_user_id' => $admin->id,
            'type' => 'bundle',
            'status' => 'in_progress',
            'client_price_cad' => 2500,
            'white_label_cost_cad' => 900,
            'scope' => 'Build launch website and start local SEO campaign for a Canadian dental clinic.',
        ]);

        $tasks = [
            ['title' => 'Collect clinic logo, photos, services, and approvals', 'visibility' => 'client_visible'],
            ['title' => 'Build homepage wireframe', 'visibility' => 'internal'],
            ['title' => 'Create Emergency Dentist service page', 'visibility' => 'internal'],
            ['title' => 'Optimize Google Business Profile services', 'visibility' => 'client_visible'],
            ['title' => 'Install analytics and conversion tracking', 'visibility' => 'internal'],
        ];

        foreach ($tasks as $task) {
            Task::firstOrCreate([
                'project_id' => $project->id,
                'title' => $task['title'],
            ], $task + ['status' => 'todo']);
        }
    }
}
