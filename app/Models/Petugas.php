<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use Authenticatable;
    use HasFactory;

    // protected $fillable = [
    //     'nama_petugas',
    //     'username',
    //     'password',
    // ];

    protected $guarded = ['id'];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
