<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Restaurant;

class restaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\Models\Restaurant::all();
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $restaurant = new Restaurant;

        $restaurant -> restaurant_name = $request -> input("restaurant_name");
        $restaurant -> restaurant_image = $request -> input("restaurant_image");
        $restaurant -> description_text = $request -> input("description_text");
        $restaurant -> location = $request -> input("location");
        $restaurant -> rating = $request -> input("rating");
        $restaurant -> opening_hours = $request -> input("opening_hours");

        if ($restaurant-> save()){
            return $restaurant;
        }

    }

    // !! timestamps auto set when save method called. JSON data of new restaurant returned.
    // turn OFF timestamp
    public $timestamps = false;

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $restaurant = Restaurant::find($request->id);

        $restaurant -> restaurant_name = $request -> input("restaurant_name");

        if ($restaurant -> save()){
            return $restaurant;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($request, $id)
    {
        $restaurant = Restaurant::find($request -> id);
        
        if ($restaurant -> delete()){
            return $restaurant;
        }
    }
}
