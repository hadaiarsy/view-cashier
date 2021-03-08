<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPiutang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'detail_piutang';
    protected $fillable = [
        'transaksi_id',
        'tanggal',
        'kasir_id',
        'uang'
    ];

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'transaksi_id', 'no_resi');
    }
}
