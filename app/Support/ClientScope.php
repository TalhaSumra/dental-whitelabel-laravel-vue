<?php

namespace App\Support;

use App\Models\Client;
use App\Models\Project;
use App\Models\MonthlyReport;
use App\Models\User;

final class ClientScope
{
    public static function canAccessClient(User $user, Client $client): bool
    {
        return $user->isInternal() || ((int) $user->client_id === (int) $client->id);
    }

    public static function canAccessProject(User $user, Project $project): bool
    {
        if ($user->isInternal()) {
            return true;
        }

        return (int) $user->client_id === (int) $project->client_id;
    }

    public static function canAccessReport(User $user, MonthlyReport $report): bool
    {
        if ($user->isInternal()) {
            return true;
        }

        return (int) $user->client_id === (int) $report->client_id && $report->status === 'published';
    }
}
