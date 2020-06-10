<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['board_id', 'content','status','memo',];
    
    public function board(){
        return $this->belongsTo(Board::class);
    }
}
