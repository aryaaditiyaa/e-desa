<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;


class Komentar extends Model
{
    protected $table = 'komentar';

    protected $fillable = ['slug', 'komentar', 'penduduk_id', 'berita_desa_id', 'info_desa_id'];

    protected $appends = [
        'nama_lengkap',
        'avatar_url'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return Carbon::parse($date)->locale('id')->isoFormat('D MMMM Y H:mm:ss');
    }

    public function getAvatarUrlAttribute()
    {
        if (Komentar::find($this->attributes['id'])->penduduk->avatar != null) {
            return url('/') . '/storage/' . str_replace("\\", "/", Komentar::find($this->attributes['id'])->penduduk->avatar);
        } else {
            return null;
        }
    }

    public function getNamaLengkapAttribute()
    {
        return Komentar::find($this->attributes['id'])->penduduk->nama_lengkap;
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id', 'id');
    }
}
