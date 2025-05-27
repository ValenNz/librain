<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

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
        return $this->hasOne(Denda::class, 'pengembalian_id');
    }

    protected function getDendaAttribute()
        {
            if (!$this->tanggal_kembali || !$this->peminjaman?->tanggal_tempo) {
                return 0;
            }

            $telat = Carbon::parse($this->tanggal_kembali)->diffInDays(Carbon::parse($this->peminjaman->tanggal_tempo));

            return $telat > 0 ? $telat * 2000 : 0;
        }
}
