<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class BeritaDesa extends Model
{
    protected $table = 'berita_desa';

    protected $appends = [
        'total_komentar',
        'gambar_url'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return Carbon::parse($date)->locale('id')->isoFormat('D MMMM Y H:mm:ss');
    }

    public function getTotalKomentarAttribute()
    {
        return Komentar::where([
            ['slug', 'berita-desa'],
            ['berita_desa_id', $this->attributes['id']]
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
}
