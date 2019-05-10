<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    protected $table="units";
    public function Admin()
    {
        return $this->belongsTo('App\Admin');
    }
}

