<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Penduduk extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'penduduk';

    protected $appends = [
        'avatar_url'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return Carbon::parse($date)->locale('id')->isoFormat('D MMMM Y H:mm:ss');
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->attributes['avatar'] != null) {
            return url('/') . '/storage/' . str_replace("\\", "/", $this->attributes['avatar']);
        } else {
            return null;
        }
    }
}
