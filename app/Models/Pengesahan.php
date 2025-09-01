<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengesahan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pengajuan(){
        return $this->belongsTo(Pengajuan::class, 'pengajuanId');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->nik)) {
                do {
                    $nik = str_pad(mt_rand(0, 9999999999999), 13, '0', STR_PAD_LEFT);
                } while (self::where('nik', $nik)->exists());

                $model->nik = $nik;
            }
        });
    }
}
