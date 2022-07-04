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
             $t.='<li key='.$item->id.'>'.$item->name.'</li>';
        }
        return $t;
    }
}
