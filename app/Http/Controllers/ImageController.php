<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function showImage($image_hash)
    {
        $data = Image::where('hash' , $image_hash)->firstorFail();

        return view('files.image' , ['data' => $data]);
    }

    public function showFullImage($image_hash)
    {
        $data = Image::where('hash' , $image_hash)->firstorFail();
        $img_location = public_path() . "/img/" . $data->hash;

        if (Input::get('thumb'))
        {
            if ($data->thumbnail === "")
            {
                $imagedata = (string) Img::make($img_location)->resize(250, 250, function($constraint){
                    $constraint->aspectRatio();
                })->encode('jpg' , 90);

                //save the thumbnail to0 the database for cachiing
                Image::Where('hash' , $image_hash)->update([
                    'thumbnail' => $imagedata
                ]);
            } else
                $imagedata = $data->thumbnail;
        } else {
            $imagedata = file_get_contents($img_location);
        }

        header("Content-Type: "  . image_type_to_mime_type($img_location));

        echo $imagedata;

    }
}
