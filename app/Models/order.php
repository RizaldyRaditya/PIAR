<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $primaryKey = 'orderId';
    protected $fillable = [
        'totalPrice','status','paidTime','paymentInfo','orderNumber'
    ];
    public function orderProduct(){
        return $this->hasMany(orderProduct::class, 'orderId','orderId');
    }
    public $timestamps = false;
}
