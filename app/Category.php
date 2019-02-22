<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = "cateid";
    protected $fillable = ['name'];

    public function forums()
    {
      return $this->hasMany('App\Forum', 'cateid', 'cateid');
    }
}
