<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;
    
    protected $fillable = ['tgl_pengaduan', 'pengaduan_id','tanggapan','petugas_id'];
}
