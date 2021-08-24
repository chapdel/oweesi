<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Support\Str;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uid = self::uid();
        });
    }

    public static function uid()
    {
        $rd = Str::random(9);
        $item = self::where('uid', $rd)->first();
        if ($item) {
            return self::uid();
        }
        return $rd;
    }

    public function subscriptions()
    {
        return $this->belongTo(Subscriber::class)->with('list');
    }
    public function user()
    {
        return $this->belongTo(User::class);
    }
}
