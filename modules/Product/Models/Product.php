<?php

namespace Product\Models;

use Category\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'count',
        'image',
        'price',
        'category_id',
        'description',
        'active',
    ];
    protected $appends=['cat','exist','is_active'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getCatAttribute($key)
    {
        return $this->category->name;
    }

    public function getExistAttribute($key)
    {
        return ($this->count>0) ? '<span className="exist_dot"></span>': '<span className="not_exist_dot"></span>';
    }

    public function getIsActiveAttribute($key)
    {
        switch ($this->active) {
            case 1:
                return '<span className="exist_dot"></span>';
            case 0:
                return '<span className="not_exist_dot"></span>';
        }
    }
}
