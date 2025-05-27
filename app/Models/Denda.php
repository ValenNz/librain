<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
