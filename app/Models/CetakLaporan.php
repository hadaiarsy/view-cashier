<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CetakLaporan extends Model
{
    use HasFactory;

    protected $table = 'cetak_laporan';
    protected $fillable = [
        'no_resi',
        'id_member',
        'id_kasir',
        'tanggal',
        'jenis_laporan',
        'no_cetak'
    ];
    public $timestamps = true;

    public static function generateNumber($data = [])
    {
        /*
         -1 -> jenis laporan
         -2 -> tanggal
         -3 -> kasir
         -4 -> no resi (optional)
         -5 -> member (optional)
        */
        if ($data[0] == 'lpj_harian') {
            $number = SELF::where(['jenis_laporan' => 'lpj_harian'])->whereDate('tanggal', '=', $data[1])->count();
            return $number == 0 ? 1 : $number + 1;
        } else if ($data[0] == 'lpb_harian') {
            $number = SELF::where(['jenis_laporan' => 'lpb_harian'])->whereDate('tanggal', '=', $data[1])->count();
            return $number == 0 ? 1 : $number + 1;
        }
    }
}
