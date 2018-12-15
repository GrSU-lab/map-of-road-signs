<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrafficLight extends Model
{
    protected $table = 'lights';

    public function photos()
    {
        return $this->hasMany('App\TrafficLightPhoto');
    }

}
