<?php

namespace Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_image extends Model
{
    protected $fillable=[
        'product_id',
        'address'
    ];
    use HasFactory;
}
