<?php

namespace App\Enums;

final class UserRole
{
    public const AGENCY_ADMIN = 'agency_admin';
    public const ACCOUNT_MANAGER = 'account_manager';
    public const DELIVERY_TEAM = 'delivery_team';
    public const CLIENT = 'client';

    public static function all(): array
    {
        return [
            self::AGENCY_ADMIN,
            self::ACCOUNT_MANAGER,
            self::DELIVERY_TEAM,
            self::CLIENT,
        ];
    }

    public static function internal(): array
    {
        return [self::AGENCY_ADMIN, self::ACCOUNT_MANAGER, self::DELIVERY_TEAM];
    }

    public static function canManageClients(string $role): bool
    {
        return in_array($role, [self::AGENCY_ADMIN, self::ACCOUNT_MANAGER], true);
    }
}
