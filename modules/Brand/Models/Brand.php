<?php

namespace Brand\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    protected $appends = ['condition'];

    public function getConditionAttribute($key)
    {
        switch ($this->status) {
            case 'active':
                return '<span className="btn btn-outline-success disabled">فعال</span>';
            case 'inactive':
                return '<span className="btn btn-outline-danger disabled">غیرفعال</span>';
        }
    }
}
