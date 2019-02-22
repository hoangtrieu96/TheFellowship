<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $table = 'messages';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = "messid";
    protected $fillable = ['title', 'content', 'userid', 'mailid'];

    public function user()
    {
      return $this->belongsTo('App\User', 'userid');
    }

    public function mailbox()
    {
      return $this->belongsTo('App\Mailbox', 'mailid');
    }
}
