<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'productId';
    protected $fillable = [
        'productCategoryId','productName','productPrice','productImage','productCreatedUserId','productModUserId'
    ];
    public $timestamps = false;

    public function vendingMachines()
    {
        return $this->belongsToMany(VendingMachine::class, 'vendingmachineproduct')->withPivot('productStock')->withTimestamps();
    }
}
