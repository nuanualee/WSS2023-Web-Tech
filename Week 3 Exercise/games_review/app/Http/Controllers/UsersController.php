<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        // check if username from req already exists in Users table
        if ($user) {
            // if exists, return error with message
            return response::json(["error" => "User already exists"]);
        }

        // if username does not exist, create new user object using user model
        $user = new User;

        // init all values within user obkject, setting api_token an empty string
        $user -> username = $request -> input("username");
        $user -> password = $request -> input("password");
        $user -> name = $request -> input("name");
        $user -> email = $request -> input("email");

        // Init as empty when register, only update during login
        $user -> api_token = "";

        // insert user into database table
        $user -> save();

        return $user;
    }


    public function login(Request $request){
        // fetch user based on username
        $user = User::where("username", $request -> input("username"))->first();

        // if username can be found
        if ($user != null){
            if ($request -> password == $user -> password){

                // generate random 60chars string for the token
                $user -> api_token = Str::random(60);
                $user -> save();

                return response::json([
                    "username" => $user -> username,
                    "token" => $user -> api_token,
                ]);
                
            } else { // given password does not match with the one in database
                return response::json(["message" => "Invalid Password"]);
            }
        } else { // the username cannot be found 
            return response::json(["message" => "Username not found!"]);
        }
    }
}
