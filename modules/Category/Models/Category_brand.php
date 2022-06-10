<?php

namespace Category\Models;

use Brand\Models\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id'
    ];

    protected $appends = ['brand'];

    public function brand_relation()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function getBrandAttribute($key)
    {
        return $this->brand_relation->name;
    }
}
