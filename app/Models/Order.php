<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seller_id',
        'number',
        'total_price',
        'delivery_address',
        'payment_status',
        'payment_url',
        'snap_url',
        'courier_name',
        'shipping_cost',

    ];

    public function user (){
        return $this->belongsTo(User::class);
    }

    public function orderItems (): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
