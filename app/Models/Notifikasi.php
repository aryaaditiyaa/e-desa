<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;


class Notifikasi extends Model
{
    protected $table = 'notifikasi';

    protected $fillable = ['slug', 'isi', 'penduduk_id', 'sudah_dibaca'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return Carbon::parse($date)->locale('id')->isoFormat('D MMMM Y H:mm:ss');
    }
}
