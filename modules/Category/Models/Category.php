<?php

namespace Category\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'image',
    ];

    protected $appends = ['parent'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getParentAttribute($key)
    {
        return ($this->category_id != null) ? $this->category->name : '-';
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'category_id', 'id');
    }

}
