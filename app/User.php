<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function boards(){
        return $this->hasMany(Board::class);
    }
    
    /**
     * このユーザのボードに絞り込む。
     */
    public function feed_boards()
    {
        // このユーザのid
        $userIds = $this->id;
        // そのユーザが所有するボードに絞り込む
        return Board::where('user_id', $userIds);
    }
}
