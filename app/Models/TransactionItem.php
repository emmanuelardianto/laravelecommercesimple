<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'product_id',
        'name',
        'price',
        'discount',
        'qty',
        'weight',
        'shipping_cost'
    ];
    
    // currency
    const CURRENCY = '$';

    public function getProductAttribute() {
        return Product::where('id', $this->product_id)->first();
    }

    public function getFormattedPriceAttribute() {
        return self::CURRENCY.number_format($this->price, 2);
    }

    public function getFormattedSubtotal() {
        return self::CURRENCY.number_format($this->price * $this->qty, 2);
    }
}
