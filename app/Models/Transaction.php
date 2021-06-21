<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\TransactionItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'email',
        'address',
        'phone',
        'payment',
        'status'
    ];

    // status
    const CART = 'CART';
    const WAITING_FOR_PAYMENT = 'WAITING_FOR_PAYMENT';
    const PAID = 'PAID';
    const HANDLING = 'HANDLING';
    const WAITING_FOR_DELIVERY = 'WAITING_FOR_DELIVERY';
    const ON_THE_WAY = 'ON_THE_WAY';
    const DELIVERED = 'DELIVERED';
    const CANCELED = 'CANCELED';
    const RETURNED = 'RETURNED';

    // payment
    const DEBIT = 'DEBIT';
    const CREDIT = 'CREDIT';
    const COD = 'COD';

    public static function addToCart(Product $product) {
        // $transactionCode = '';
        $transaction = null;
        // if(empty($transactionCode)) {
        //     $transaction = self::where('status', self::CART)->orderBy('updated_at', 'desc')->first();
        //     if(is_null($transaction)) {
        //         $transactionCode = Str::random(11);
        //     } else {
        //         $cookie = cookie('transaction_code', $transactionCode, 1 * 60 * 24 * 7);
        //     }
        // }
        
        $user = Auth::check() ? Auth::user() : null;
        if(!is_null($user)) {
            $transaction = self::where('user_id', $user->id)->where('status', self::CART)->orderBy('updated_at', 'desc')->first();
            if(!is_null($transaction))
                $transactionCode = $transaction->code;
            else
                $transactionCode = Str::random(11);
        } else {
            $transactionCode = Str::random(11);
        }
        if(is_null($transaction)) {
            $transaction = self::create([
                'code' => $transactionCode,
                'user_id' => is_null($user) ? null : $user->id,
                'email' => is_null($user) ? null : $user->email,
                'payment' => self::DEBIT,
                'status' => self::CART
            ]);
        }

        $transactionItem = TransactionItem::where('transaction_id', $transaction->id)->where('product_id', $product->id)->first();

        if(is_null($transactionItem)) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1
            ]);
        } else {
            $transactionItem->qty += 1;
            $transactionItem->save();
        }
    }

    public static function removeFromCart(TransactionItem $transactionItem) {
        $transactionItem->delete();
    }

    public function getItemsAttribute() {
        return TransactionItem::where('transaction_id', $this->id)->get();
    }

    public function getSubtotalAttribute() {
        $subtotals = collect($this->items)->map(function($item) {
            return $item->price * $item->qty;
        });

        return $subtotals->sum();
    }

    public function getQtyAttribute() {
        return collect($this->items)->sum('qty');
    }
}
