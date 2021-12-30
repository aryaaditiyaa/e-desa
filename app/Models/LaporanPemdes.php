<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;


class LaporanPemdes extends Model
{
    protected $table = 'laporan_pemdes';

    protected $fillable = [
        'penduduk_id',
        'jenis_aspirasi',
        'isi',
        'gambar1',
        'gambar2',
        'gambar3'
    ];

    protected $appends = [
        'gambar1_url',
        'gambar2_url',
        'gambar3_url'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return Carbon::parse($date)->locale('id')->isoFormat('D MMMM Y H:mm:ss');
    }

    public function getGambar1UrlAttribute()
    {
        if ($this->attributes['gambar1'] != null) {
            return url('/') . '/storage/' . str_replace("\\", "/", $this->attributes['gambar1']);
        } else {
            return null;
        }
    }

    public function getGambar2UrlAttribute()
    {
        if ($this->attributes['gambar2'] != null) {
            return url('/') . '/storage/' . str_replace("\\", "/", $this->attributes['gambar2']);
        } else {
            return null;
        }
    }

    public function getGambar3UrlAttribute()
    {
        if ($this->attributes['gambar3'] != null) {
            return url('/') . '/storage/' . str_replace("\\", "/", $this->attributes['gambar3']);
        } else {
            return null;
        }
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id', 'id');
    }
}
