<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;


class InfoDesa extends Model
{
    protected $table = 'info_desa';

    protected $appends = [
        'total_komentar',
        'gambar_url',
        'dokumen_url'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return Carbon::parse($date)->locale('id')->isoFormat('D MMMM Y H:mm:ss');
    }

    public function getTotalKomentarAttribute()
    {
        return Komentar::where([
            ['slug', 'info-desa'],
            ['info_desa_id', $this->attributes['id']]
        ])->count();
    }

    public function getGambarUrlAttribute()
    {
        if ($this->attributes['gambar'] != null) {
            return url('/') . '/storage/' . str_replace("\\", "/", $this->attributes['gambar']);
        } else {
            return null;
        }
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
}
