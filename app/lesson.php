<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lesson extends Model
{
    protected $primaryKey ="L_id";
    public function unit()
    {
        return $this->belongsTo('App\unit');
    }
}
