<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;


class Surat extends Model
{
    protected $table = 'surat';

    protected $fillable = ['status', 'penduduk_id', 'jenis_surat', 'dokumen'];

    protected $appends = [
        'dokumen_url'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return Carbon::parse($date)->locale('id')->isoFormat('D MMMM Y H:mm:ss');
    }

    public function getDokumenUrlAttribute()
    {
        if (($this->attributes['dokumen']) != '[]') {
            if (!empty(json_decode($this->attributes['dokumen'])[0])) {
                return url('/') . '/storage/' . str_replace("\\", "/", json_decode($this->attributes['dokumen'])[0]->download_link);
            }
        } else {
            return null;
        }
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id', 'id');
    }
}
