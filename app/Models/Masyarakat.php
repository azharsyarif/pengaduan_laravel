<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Masyarakat extends Model 
{
    use HasApiTokens;
    use Authenticatable;
    use HasFactory;

    protected $fillable = [
    'id',
    'nik',
    'nama',
    'username',
    'password',
    'telp'
];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function generateToken()
    {
        $token = str::random(60); // Generate a random token
        $this->api_token = hash('sha256', $token); // Store hashed token in 'api_token' column or as required
        $this->save();

        return $token; // Return the non-hashed token for response
    }

    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class);
    }

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'nik', 'nik');
    }
}
