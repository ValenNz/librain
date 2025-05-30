<?php

namespace App\Models;

use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $fillable = ['nama', 'email', 'telepon', 'foto', 'status'];


    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'anggota_id');
    }
}
