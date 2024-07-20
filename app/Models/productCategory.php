<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productCategory extends Model
{
    use HasFactory;
    protected $table = 'productCategory';
    protected $primaryKey = 'productCategoryId';
    protected $fillable = [
        'productCategoryName'
    ];
    public $timestamps = false;
}
