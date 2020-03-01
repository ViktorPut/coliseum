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
    public function index()
    {
        $houses = App\House::all();
        return view('house/house_index', compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = App\Category::all();
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
        //


        $address = new App\Address([
            'number'        => $request->number ?: '*',
            'city_id'       => (App\City::firstOrCreate([ 'name' => $request->city]))->id,
            'district_id'   => (App\District::firstOrCreate([ 'name' => $request->district]))->id,
            'street_id'     => $street->id
        ]);
        $address->save();

        $house = new App\House();

        $house->fill([
            'rooms'  => $request->rooms ?: '*',
            'floors' => $request->floors ?: '*',
            'cost'   => $request->cost,
            'space'  => $request->space,
            'description' => $request->description ?: '*',
            'category_id' => $request->category,
        ]);
        $house->address_id = $address->id;
        $house->save();

//        if(Auth::user()->isAdmin()){
//            $house->users()->attach($request->user);
//        }else{
//            $house->users()->attach(Auth::user()->id);
//        }

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
        return view('house/house_edit', compact('house'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, App\House $housed)
    {
        //

        return redirect('/');
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
        return redirect('/');
    }
}
