<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $table = 'topics';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = 'topiid';
    protected $fillable = ['name', 'content', 'userid', 'foruid'];

    public function forum()
    {
      return $this->belongsTo('App\Forum', 'foruid');
    }

    public function user()
    {
      return $this->belongsTo('App\User', 'userid');
    }

    public function comments()
    {
      return $this->hasMany('App\Comment', 'topiid', 'topiid');
    }
}
