<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    public function unit()
    {
        return $this->hasMany('App\unit');
    }
}
