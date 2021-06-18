<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'name'
    ];


    public static function getGroupedByUser($userId) {
        $wishlists = self::join('products', 'products.id', 'wishlists.product_id')
                        ->where('user_id', $userId)->get();

        $wishlists = collect($wishlists)->groupBy('name')->values();

        return $wishlists;
    }

    public function getProductAttribute() {
        return \App\Models\Product::where('id', $this->product_id)->first();
    }
 }
