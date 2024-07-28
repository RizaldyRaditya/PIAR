<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendingmachine extends Model
{
    use HasFactory;

    protected $primaryKey = 'machineId';
    protected $fillable = ['machineCode','machineName','note'];

    public function products()
    {
        return $this->belongsToMany(product::class, 'vendingmachineproduct')->withPivot('productStock')->withTimestamps();
    }
}
