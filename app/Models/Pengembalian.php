<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Denda;
use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';

    protected $fillable = ['peminjaman_id', 'tanggal_kembali', 'catatan_kondisi'];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function denda()
    {
        return $this->hasOne(Denda::class);
    }
}
