<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class user extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'userId';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'userId','username','email','password'
    ];

     protected $hidden = [
        'password'
     ];
    }
