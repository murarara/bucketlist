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
}
