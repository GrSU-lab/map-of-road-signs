<?php

namespace App\Listeners;
use Unisharp\Laravelfilemanager\Events\ImageWasUploaded;

class HasUploadedImageListener
{
    /**
     * Handle the event.
     *
     * @param  ImageWasUploaded  $event
     * @return void
     */

    public function handle(ImageWasUploaded $event)
    {
        $path = $event->path();



        if(stripos($path,gpsPhoto))
        {
            $img_resize = Image::make($path)->resize(50, 50);
            $img_resize->save(public_path('\\files\\photos\\gpsPhoto\\ico\\' .basename($path)));
        }
    }

}