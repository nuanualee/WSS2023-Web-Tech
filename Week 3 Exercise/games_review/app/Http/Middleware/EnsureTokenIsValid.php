<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);

        $token = $request -> header("api_token");

        // if no token is provided
        if ($token == null || $token == ""){
            return response() -> json(["message" => "User not found"]);
        }

        // fetching first user with that token
        $user = User::where("api_token", $token) -> first();

        // if there is such a user with that token, proceed to pass on request
        if ($user){
            return $next($request);
        } else {
            return response() -> json(["message" => "User not found"]);
        }
    }
}
