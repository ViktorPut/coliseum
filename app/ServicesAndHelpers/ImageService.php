<?php

namespace App\ServicesAndHelpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ImageService{
    protected $request;
    protected $publicPath = 'public/photos/house_photos/';
    protected $storagePath = 'storage/photos/house_photos/';
    protected $filesExtension = 'png';
    protected $declineExtension = [
        'png',
        'jpeg',
        'jpg',
        'gif',
        'bmp',
        'webp',
    ];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function createStorage($id){
        if(!Storage::exists($this->publicPath.$id)) {
            Storage::makeDirectory($this->publicPath . $id);
        }
    }

    public function attach(\App\House $house){
        if(!$this->request->has('images')){
            return;
        }
        $this->createStorage($house->id);
        foreach ($this->request->images as $image){

            if(!$this->checkExtension($image)) continue;

            $path = $this->create($house, $image);
            $file = new \App\Photo();
            $file->path = $path;
            $file->rank = $this->request->has('rank') ? $this->request->rank : 100;

            $house->photos()->save($file);
        }
    }

    public function changeSize($image){
        $width = $image->width();
        $height = $image->height();
        //уменьшим в 2 раза размер
        if ($width > 1280){
            $width /= 2;
        }
        if($height > 720 ){
            $height /= 2;
        }
        return $image->resize($width, $height);
    }

    public  function  getFileName($house){
        while (true) {
            $name = uniqid() .'.'. $this->filesExtension;
            $path = $this->storagePath . $house->id . '/';
            if(!file_exists($path.$name)){
                return $path.$name;
            }
        }
    }

    public function create($house, $image){
        $path = $this->getFileName($house);
        $newImage = Image::make($image->getRealPath());
        $this->changeSize($newImage)->save($path);
        return $path;
    }

    public function checkExtension($image){
        return in_array($image->clientExtension(), $this->declineExtension);
    }
}
?>
