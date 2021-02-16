<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'member';
    protected $primaryKey = 'kode_member';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'kode_member',
        'jenis_member',
        'nama',
        'unit',
        'telepon',
        'alamat'
    ];

    public static function incrementId()
    {
        $date = date('ymd');
        $lastId = Self::withTrashed()->orderBy('kode_member', 'desc')->first();
        if ($lastId) {
            $lastId = $lastId->kode_member;
            $lastId = preg_replace('/M-/', '', strval($lastId));
            if (preg_match('/^' . $date . '/', $lastId)) {
                $val = (int)preg_replace('/^' . $date . '/', '', $lastId) + 1;
                $val =  str_pad($val, 3, "0", STR_PAD_LEFT);
                return 'M-' . $date . $val;
            } else {
                return 'M-' . $date . '001';
            }
        } else {
            return 'M-' . $date . '001';
        }
    }

    public static function getName()
    {
        $lastName = Self::withTrashed()->where('nama', 'like', '%Customer-%')->orderBy('kode_member', 'desc')->get();
        if ($lastName->count()) {
            $lastName = preg_replace('/Customer-/', '', strval($lastName->first()->nama));
            $val = (int)$lastName + 1;
            $val =  str_pad($val, "0", STR_PAD_LEFT);
            return 'Customer-' . $val;
        } else {
            return 'Customer-1';
        }
    }

    public static function checkName($name)
    {
        if ($name == null) return false;
        if (preg_match('/__/', $name)) {
            $name = explode('__', $name);
            return $name[1];
        } else {
            return false;
        }
    }

    public function transaksi()
    {
        return $this->hasManyThrough('detail_transaksi', 'Transaksi', 'kasir_id', 'id');
    }
}
