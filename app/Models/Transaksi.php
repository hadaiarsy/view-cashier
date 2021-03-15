<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaksi';
    protected $primaryKey = 'no_resi';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'tanggal',
        'jenis_transaksi',
        'kasir_id',
        'member_id',
        'total',
        'diskon',
        'uang',
        'is_lunas',
        'batas_waktu'
    ];

    public static function incrementId()
    {
        $date = date('ymd');
        $lastId = Self::withTrashed()->orderBy('no_resi', 'desc')->first();
        if ($lastId) {
            $lastId = $lastId->no_resi;
            $lastId = preg_replace('/INV-/', '', $lastId);
            if (preg_match('/^' . $date . '/', $lastId)) {
                $val = (int)preg_replace('/^' . $date . '/', '', $lastId) + 1;
                $val =  str_pad($val, 3, "0", STR_PAD_LEFT);
                return 'INV-' . $date . $val;
            } else {
                return 'INV-' . $date . '001';
            }
        } else {
            return 'INV-' . $date . '001';
        }
    }

    public function kasir()
    {
        return $this->hasOne(User::class, 'id', 'kasir_id');
    }

    public function member()
    {
        return $this->hasOne(Member::class, 'kode_member', 'member_id');
    }

    public function detail()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id', 'no_resi');
    }

    public function piutang()
    {
        return $this->hasMany(DetailPiutang::class, 'transaksi_id', 'no_resi');
    }
}
