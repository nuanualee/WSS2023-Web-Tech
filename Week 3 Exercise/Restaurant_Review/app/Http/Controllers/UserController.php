<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\Models\User::all();
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
    }

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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function register(Request $request){
        $user = User::find($request -> input("username"));

        if ($user){
            return response() -> json(["error" => "User already exists"]);
        }

        $user = new User;

        $user -> username = $request -> input("username");
        $user -> password = $request -> input("password");
        $user -> email = $request -> input("email");
        $user -> api_token = "";

        $user -> save();

        return $user;
    }

    public function login(Request $request){
        $user = User::where("username", $request -> input("username"))->first();

        if ($user != null){
            if ($request -> password == $user -> password){

                $user -> api_token = Str::random(60);
                $user -> save();

                return response() -> json([
                    "username" => $user -> username,
                    "token" => $user -> api_token,
                ]);
            }
        }


    }
}
