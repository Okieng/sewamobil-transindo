<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjamans';
    protected $fillable = ['mobil_id', 'tanggal_mulai', 'tanggal_selesai', 'tanggal_pengembalian', 'jumlah_hari', 'biaya_sewa'];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}
