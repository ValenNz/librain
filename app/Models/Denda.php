<?php

namespace App\Models;

use App\Models\Anggota;
use App\Models\Pengembalian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Denda extends Model
{
    use HasFactory;

    protected $table = 'denda';

    protected $fillable = ['pengembalian_id', 'jumlah', 'alasan', 'status'];
    public function pengembalian()
    {
        return $this->belongsTo(Pengembalian::class);
    }

    public function anggota()
    {
        return $this->hasOneThrough(Anggota::class, Pengembalian::class, 'peminjaman_id', 'anggota_id');
    }
}
