<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    protected $table="units";
    protected $primaryKey ="UN_id";
    public function Admin()
    {
        return $this->belongsTo('App\Admin');
    }
    public function course()
    {
        return $this->belongsTo('App\course');
    }
    public function lesson()
    {
        return $this->hasMany('App\lesson');
    }
}

