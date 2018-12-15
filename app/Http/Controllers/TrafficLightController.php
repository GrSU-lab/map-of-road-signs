<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TrafficLight;
use App\TrafficLightPhoto;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Symfony\Component\HttpFoundation\Response;
use Intervention\Image\ImageManagerStatic as Image;

class TrafficLightController extends Controller
{

    public function store(Request $request)
    {
        $light = new TrafficLight;
        $input = $request->all();
       // $lightdata=json_decode( $input);
        $light->name= $input['name'];
        $light->coordinate= $input['coordinate'];
        $light->created_at= $input['created_at'];
        $light->updated_at = $input['updated_at'];
        $lightid=$light->id;
        foreach ($input['images'] as $image) {
            $lightphoto = new TrafficLightPhoto;
            $lightphoto->image_path=$image;
            $lightphoto->light_id=$lightid;
            $lightphoto->save();
        }
        $light->save();

    }


    public function delete($id)
    {

        $light = App\TrafficLight::find($id);
        for(;;)
        {
            try {
                $photos = App\TrafficLightPhoto::where('light_id', $id)->firstOrFail();
                $photos->delete();
            }
            catch (\Exception $e){break;}
        }

        $light->delete();

    }

    public function showall()
    {
        $arr=[];

        $lights = DB::select('select * from lights');
        foreach ($lights as $light) {
            $imgarr=[];
            $lightsimage = DB::select('select * from lightspictures where light_id=:id', ['id' => $light->id]);
            foreach ($lightsimage as $image) {
                array_push($imgarr,$image->image_path);
            }
            $light2array = ['id' => $light->id, 'name' => $light->name, 'created_at' => $light->created_at ,'updated_at' => $light->updated_at ,'coordinate' => $light->coordinate,'images' => $imgarr];
            array_push($arr, $light2array);
        }
        $jsonlights=json_encode($arr);
        return $jsonlights;
    }

    public function showid($id)
    {

        $lights = DB::select('select * from lights where id = :id', ['id' => $id]);
        foreach ($lights as $light) {
            $imgarr=[];
            $lightsimage = DB::select('select * from lightspictures where light_id=:id', ['id' => $light->id]);
            foreach ($lightsimage as $image) {
                array_push($imgarr,$image->image_path);
            }
            $light2array = ['id' => $light->id, 'name' => $light->name, 'created_at' => $light->created_at ,'updated_at' => $light->updated_at ,'coordinate' => $light->coordinate,'images' => $imgarr];

        }
        $jsonlights=json_encode( $light2array);
        return $jsonlights;
    }

    public function change(Request $request,$id)
    {

        $light = DB::select('select * from lights where id = :id', ['id' => $id]);

        $input = $request->all();

        $light->name= $input['name'];
        $light->coordinate= $input['coordinate'];
        $light->created_at= $input['created_at'];
        $light->updated_at = $input['updated_at'];
        $lightid=$light->id;
        //???????????????????
        foreach ($input['images'] as $image) {
            $lightphoto = DB::select('select * from lightspictures where light_id=:id', ['id' => $light->id]);

            $lightphoto->image_path=$image;
            $lightphoto->light_id=$lightid;
        }
        //????????????????????????
        $light->touch();
        $light->save();
    }

}
