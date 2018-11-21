<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use App\Photo;
use Symfony\Component\HttpFoundation\Response;
use Intervention\Image\ImageManagerStatic as Image;

class PhotoController extends Controller
{
    public function index()
    {
		$photos = [
		    [
			    'id' => 1,
				'imageSrc' => url('files/photo/1.jpg'),
				'thumbnail' => url('files/photo/thumbnail/1.jpg'),
				'coordinates' => [
				    53.6879952,
					23.8496112
				]
			],
			[
			    'id' => 2,
				'imageSrc' => url('files/photo/2.jpg'),
				'thumbnail' => url('files/photo/thumbnail/2.jpg'),
				'coordinates' => [
				    53.6654619,
					23.8232123
				]
			]
		];
		
		return response()->json($photos);
	}

    public function showall()
    {
        $dir = public_path('\\files\\photos\\');
        $images = scandir($dir);

        $arr=[];

        foreach ($images as $image)
        {
            if (!($image=="."||$image==".."||$image=="ico"))
            {
                $coord=$this->read_gps(public_path('\\files\\photos\\').$image);
                $img=['name'=>$image,'url' =>('\\files\\photos\\'), 'geo' => $coord];
                array_push($arr, $img);
            }
        }
        $photos=json_encode($arr);
        return view('photos.index', compact('photos'));
    }
    public function showid($id)
    {

        $dir = public_path('\\files\\photos\\');
        $images = scandir($dir);

        foreach ($images as $image)
        {
            if ((!($image=="."||$image==".."||$image=="ico")) and $image==$id)
            {
                $coord=$this->read_gps(public_path('\\files\\photos\\').$image);
                $img=['name'=>$image,'url' =>('\\files\\photos\\'), 'geo' => $coord];
            }
        }

        $photo=json_encode($img);
        return view('photos.index_one', compact('photo'));

    }



    function getGps($exifCoord, $hemi)
    {
        $pc = new PhotoController;
        $degrees = count($exifCoord) > 0 ? $this->gps2Num($exifCoord[0]) : 0;
        $minutes = count($exifCoord) > 1 ? $this->gps2Num($exifCoord[1]) : 0;
        $seconds = count($exifCoord) > 2 ? $this->gps2Num($exifCoord[2]) : 0;
        $flip = ($hemi == 'W' or $hemi == 'S') ? -1 : 1;
        return $flip * ($degrees + $minutes / 60 + $seconds / 3600);
    }

    function gps2Num($coordPart) {
        $parts = explode('/', $coordPart);
        if (count($parts) <= 0)
            return 0;
        if (count($parts) == 1)
            return $parts[0];
        return floatval($parts[0]) / floatval($parts[1]);
    }

    function read_gps($file)
    {
        if (is_file($file)) {
            $exif = exif_read_data($file);
            $lon = $this->getGps($exif['GPSLongitude'], $exif['GPSLongitudeRef']);
            $lat = $this->getGps($exif['GPSLatitude'], $exif['GPSLatitudeRef']);
            return array(
                $lat,
                $lon
            );
        }
        return false;
    }

    public function create()
    {
        return view('photos.upload');
    }

    public function createIcon($image_path, $image_name)
    {
        $img_resize = Image::make($image_path)->resize(300, 300);

        $img_resize->save(public_path('\\files\\photos\\ico\\' .$image_name));
    }


    public function delete($id)
    {

        unlink(public_path('\\files\\photos\\').$id);
        unlink(public_path('\\files\\photos\\ico\\').$id);
        return redirect('/');
    }

    public function loadImg()
    {
        $imageName = time().'.'.request()->input_img->getClientOriginalExtension();
        request()->input_img->move(public_path('\\files\\photos\\'), $imageName);

        $photoPath = addslashes(public_path('files\\photos')."\\".$imageName);
        $this->createIcon($photoPath, $imageName);

        return redirect('/')->with('success', 'Image Upload successfully');

    }

}
