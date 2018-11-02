<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
