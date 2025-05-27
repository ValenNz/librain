<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

protected $fillable = [
    'anggota_id',
    'buku_id',
    'tanggal_pinjam',
    'tanggal_tempo',
    'tanggal_kembali',
];

   public function pengembalian()
{
    return $this->hasOne(Pengembalian::class);
}

public function buku()
{
    return $this->belongsTo(Buku::class);
}

public function anggota()
{
    return $this->belongsTo(Anggota::class);
}
}
