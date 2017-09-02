<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Board extends Model{

   protected $fillable=[
       'name',
       'user_id',
   ];
    protected $guarded=[];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}