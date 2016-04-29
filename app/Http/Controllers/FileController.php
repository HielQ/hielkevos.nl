<?php

namespace App\Http\Controllers;

use App\Download;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class FileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        return view('home.upload');
    }

    /**
     * @return mixed
     */

    public function serve($version, $name)
    {
        $file = Download::where(['version' => $version , 'name' => urlencode($name)])->firstOrfail();

        return Response::download($file->path, $file->name);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function filelist()
    {
        $files = Download::orberBy('name' , 'asc')->get();

        return view('files.filelist' , ['files'=>$files]);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function imagelist()
    {
        $data = Image::orderBy('id' , 'desc')->get();

        return view('files.imagelist' , ['images' => $data]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function imageoverview()
    {
        $data = Image::all();

        return view('files.overview', ['images' =>$data]);
    }

    /**
     * @return mixed
     */

    public function savefile()
    {
        if (Input::hasfile('file'))
        {
            $file = Input::file('file');
            $key = Input::get('key');
            $name = $file->getClientOrignalName();
            $hash = self::createFilehash();

           //check if the file was snet is actuall an file
            $validator = Validator::make(
                ['file' => $file] ,
                ['file' => 'required|mimes:zip']
            );

            if (!$validator->fails())
            {
                $manifest = \Zipper::make($file->getRealPath())->getFileContent('mainfest.json');

                $zipValidator = Validator::make(
                    ['manifest' => $manifest],
                    ['manifest' => 'JSON']
                );

                if (!$zipValidator->fails())
                {
                    $manifest = json_decode($manifest);

                    $path = storage_path() . "/dl/" . $manifest->name ."/" . $manifest->version;

                    Download::create(([
                        'name' => $name,
                        'descr' =>$manifest->description,
                        'hash' => $hash,
                        'version' => $manifest->version,
                        'author' => $manifest->author,
                        'path' => $path . "/" . $hash
                    ]));

                    $url = URL::to('/f/' . $manifest->version . '/' . urlencode($name));

                    $file->move($path, $hash);

                    return Redirect::intended('upload')->with([
                        'file_name' => $name,
                        'url' => $url
                    ]);
                } else {
                    return Redirect::back()->with(
                        ['type' => 'danger'],
                        ['message' => 'Invalid or missing manifest.json']
                    );
                }
            } else {
                Redirect::back()->with(
                    ['type' => 'danger'],
                    ['message' => 'Invalid file']
                );
            }

        }
        return Redirect::to('upload')->with(
            ['type' => 'danger'],
            ['message' => 'No file attached!']
        );
    }





    public function saveImage()
    {
        if (Input::hasfile('image')) {

            $image = Input::file('image');
            $name = (Input::has('name') ? Input::get('name') : "");
            $key = Input::get('key');
            $image_name = $image->GetClientOrignalName();
            $image_hash = self::createImageHash();


            if ($key === env('APP_KEY') || Session::token() === Input::get('_token')) {
                //check whetever the file is an imaging or not
                $validator = Validator::make(
                    ['image' => $image],
                    ['image' => 'image']
                );
                //check wheter the validation has failed or not

                if (!$validator->fails()) {
                    $imagedata = (string)Img::make($image)->rezize(250, 250, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode('jpg', 90);

                    Image::create([
                        'name' => ($name === "" ? $image_name : $name),
                        'hash' => $image_hash,
                        'thumbnail' => $imagedata
                    ]);

                    $image->move(public_path() . "/img/", $image_hash);

                    if (Input::has('_token'))
                        return Redirect::intended('upload')->with([
                            'hash' => $image_hash
                        ]);
                    else
                        return URL::to('/s') . "/" . $image_hash;

                } else {
                    die("unsupported extension");
                }

            } else {
                die("Incorrect token/key");
            }
        } else {
            die("no file attached");
        }

    }

    /**
     * @return string
     */

    private function createImageHash() {
        $fc = count(scandir(storage_path() . "/dl"));

        //keep running

        while(true) {
            $hash = base64_encode($fc * mt_rand(2 , $fc * $fc));

            if(!file_exists(storage_path() . "/dl/" . $hash)) {
                break;
            }
        }
        return $hash;

    }

    private function createFileHash() {
        $fc = count(scandir(storage_path() . "/dl"));

        //keep running

        while(true) {
            $hash = base64_encode($fc * mt_rand(2 , $fc * $fc));

            if(!file_exists(storage_path() . "/dl/" . $hash)) {
                break;
            }
        }
        return $hash;
    }




}
