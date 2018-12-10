<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TrafficLight;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Symfony\Component\HttpFoundation\Response;
use Intervention\Image\ImageManagerStatic as Image;

class TrafficLightController extends Controller
{

    public function store(Request $request)
    {
        $light = new TrafficLight;
        $input = $request->all();
        $lightdata=json_decode( $input);
        $light->name= $lightdata['name'];
        $light->coordinate= $lightdata['coordinate'];
        $light->created_at= $lightdata['created_at'];
        $light->updated_at = $lightdata['updated_at'];




    }

}
