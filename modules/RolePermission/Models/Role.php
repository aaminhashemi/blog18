<?php


namespace RolePermission\Models;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $appends = ['permission_list'];

    public function getPermissionListAttribute()
    {
        $t='';
        foreach ($this->permissions as $item) {
             $t.='<li>'.$item->name.'</li>';
        }
        return 'llll';
    }
}
