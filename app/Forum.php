<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    //
    protected $table = 'forums';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = "foruid";
    protected $fillable = ['name', 'cateid'];

    public function category()
    {
      return $this->belongsTo('App\Category', 'cateid');
    }

    public function topics()
    {
      return $this->hasMany('App\Topic', 'foruid', 'foruid');
    }
}
