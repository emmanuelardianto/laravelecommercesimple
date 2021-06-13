<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'status',
        'price',
        'image_url'
    ];

    public function getRouteKeyName() {
        return 'slug';
    }

    public function getImageUrlAttribute($value) {
        if(empty($value))
            return 'http://placehold.jp/150x150.png';

        return '/images/'.$value;
    }
}
