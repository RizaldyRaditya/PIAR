<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderProduct extends Model
{
    use HasFactory;
    protected $table = 'orderProduct';
    protected $primaryKey = 'orderProductId';
    protected $fillable = [
        'orderId','productId','productName','price','qty','totalPrice'
    ];

    public function order() {
        return $this->belongsTo(order::class, 'orderId','orderId');
    }
    public $timestamps = false;
}
