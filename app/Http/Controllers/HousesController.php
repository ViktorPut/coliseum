<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HousesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only('destroy');
        $this->middleware('manager')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $houses = App\House::with('address');
        $houses = (new App\ServicesAndHelpers\HousesFilters($houses, $request))->apply();
        $houses = $houses->simplePaginate(2);
        return view('house/house_index', compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = App\Category::pluck( 'real_name', 'id');
        $managers = App\User::getManagerList();
        return view('house/house_create', compact('categories', 'managers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        (new App\ServicesAndHelpers\HouseService( $request))->createHouse();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(App\House $house)
    {
        return view('house/house_show', compact('house'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(App\House $house)
    {
        $categories = App\Category::pluck( 'real_name', 'id');
        $managers = App\User::getManagerList();
        return view('house/house_edit', compact('house', 'categories', 'managers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, App\House $house)
    {
        //
        (new App\ServicesAndHelpers\HouseService($request))->updateHouse($house);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(App\House $house)
    {
        //
        Storage::deleteDirectory('public/photos/house_photos/'.$house->id);

        $house->delete();
        return back();
    }
}
