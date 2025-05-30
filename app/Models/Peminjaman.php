<?php

namespace App\Models;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Pengembalian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
