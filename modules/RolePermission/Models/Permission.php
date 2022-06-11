<?php

namespace RolePermission\Models;

class Permission extends \Spatie\Permission\Models\Permission
{
    protected $appends=['tat'];

    const PERMISSION_MANAGE_CATEGORIES = 'manage_categories';

    static $permissions = [
        self::PERMISSION_MANAGE_CATEGORIES,
    ];

    public function getTatAttribute(){
        return 'hhh';
    }

}
