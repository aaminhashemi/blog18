<?php

namespace RolePermission\Models;

class Permission extends \Spatie\Permission\Models\Permission
{
    protected $appends=['tat'];

    const PERMISSION_MANAGE_CATEGORIES = 'manage_categories';
    const PERMISSION_MANAGE_PERMISSIONS = 'manage_companies';

    static $permissions = [
        self::PERMISSION_MANAGE_PERMISSIONS,
        self::PERMISSION_MANAGE_CATEGORIES,
    ];

}
