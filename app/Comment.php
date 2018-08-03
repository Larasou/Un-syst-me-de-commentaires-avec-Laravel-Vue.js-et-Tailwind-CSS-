<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'body', 'ip'];
    protected $with = ('user');


    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            if (auth()->check()) {
                $model->ip = request()->ip();
            }
        });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
