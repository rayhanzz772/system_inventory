<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pinjam extends Model
{
    protected $table = "pinjams";
    protected $primaryKey = "nim"; // Atur primary key ke kolom 'nim'
    public $incrementing = false; // Pastikan nilai primary key tidak secara otomatis bertambah
    public $timestamps = false;

    protected $fillable = [
        'nim',
        'nama_peminjam',
        'dosen',
        'ruang',
        'mata_kuliah',
        'tanggal_peminjaman',
        'waktu_peminjaman',
        'waktu_pengembalian'
    ];

}
