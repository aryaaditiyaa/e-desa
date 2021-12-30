<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;


class Desa extends Model
{
    protected $table = 'desa';

    protected $appends = [
        'logo_desa_url'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return Carbon::parse($date)->locale('id')->isoFormat('D MMMM Y H:mm:ss');
    }

    public function getLogoDesaUrlAttribute()
    {
        if ($this->attributes['logo_desa'] != null) {
            return url('/') . '/storage/' . str_replace("\\", "/", $this->attributes['logo_desa']);
        } else {
            return null;
        }
    }
}
