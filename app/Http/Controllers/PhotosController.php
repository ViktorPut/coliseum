<?php

namespace App\Http\Controllers;

use App\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('manager');
    }

    public function destroy(App\Photo $photo){
        Storage::delete($photo->path);
        $photo->delete();
        return back();
    }

//    public function create(Request $request, House $house){
//
//    }
}
