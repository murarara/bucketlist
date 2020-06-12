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
    
    // このユーザを閲覧許可しているボード
    public static function share_boards(){
        return $this->belongsToMany(Board::class, 'board_share', 'user_id', 'board_id')->withTimestamps();
    }
    
    // $board_idで指定されたボードを閲覧許可にする。
    public function share($user_id,$board_id){
        // すでに閲覧許可しているかの確認
        $exist = $user_id->is_sharing($user_id, $board_id);

        if ($exist) {
            // すでにシェアしていれば何もしない
            return false;
        } else {
            // 閲覧の許可をする
            $user_id->share_boards()->attach($board_id);
            return true;
        }
    }
    
    public function is_sharing($user_id, $board_id){
        // シェア中ボードの中に $board_idのものが存在するか
        return $user_id->share_boards()->where('board_id', $board_id)->exists();
    }

    //このユーザのボードに絞り込む。
    public function feed_boards(){
        // このユーザのid
        $user_id = $this->id;
        
        // そのユーザが所有するボードに絞り込む
        return Board::where('user_id', $user_id);
    }

    //このユーザが閲覧許可されているボードに絞り込む。
    public function feed_share_boards(){
        // このユーザが閲覧許可されている board_id を取得して配列にする
        $boards_id = $this->share_boards()->pluck('boards.id')->toArray();
        
        // それらのボードに絞り込む
        return Board::whereIn('id', $boards_id);
    }
}
