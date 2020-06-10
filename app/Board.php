<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = ['title','desc',];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function tasks(){
        return $this->hasMany(Task::class);
    }
    
    /**
     * このボードのタスクに絞り込む。
     */
    public function feed_tasks()
    {
        // このボードのid
        $boardIds = $this->id;
        // そのユーザが所有するボードに絞り込む
        return Task::where('board_id', $boardIds);
    }
}
