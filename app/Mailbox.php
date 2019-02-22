<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailbox extends Model
{
    //
    protected $table = 'mailboxes';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = "mailid";
    protected $fillable = ['userid'];

    public function user()
    {
      return $this->belongsTo('App\User', 'userid');
    }

    public function messages()
    {
      return $this->hasMany('App\Message', 'mailid', 'mailid');
    }
}
