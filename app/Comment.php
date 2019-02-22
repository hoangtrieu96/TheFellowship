<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = 'commid';
    protected $fillable = ['content', 'quote', 'userid', 'topiid'];

    public function user()
    {
      return $this->belongsTo('App\User', 'userid');
    }

    public function topic()
    {
      return $this->belongsTo('App\Topic', 'topiid');
    }
}
