<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
           if (app()->environment('local')) {
               $model->avatar =  '/images/persons/png/man.png';
           }
        });

        self::created(function ($user) {
            if (app()->environment('local')){
                User::first()->update([
                    'name' => 'Soulouf',
                    'avatar' =>  '/images/persons/png/man.png',
                    'email' => 'contact@larasou.com',
                ]);
            }
        });
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public static function admin() {
        if (auth()->check() && auth()->id() === 1)
            return true;
        return false;
    }
}
