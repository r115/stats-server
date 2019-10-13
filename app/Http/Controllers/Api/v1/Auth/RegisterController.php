<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller{
    /**
     * RegisterController constructor.
     */
    function __construct()
    {
    }

    /**
     * Register a new user.
     *
     * This relies on machine-machine auth so an api key has to be provided as a part of the request.
     *
     * @param Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request){
        // Check for authentication key
        $auth_key = $request->bearerToken();

        // Validate auth key
        if ($auth_key) {
            $client = DB::table('oauth_clients')
                ->where('secret', $auth_key)
                ->where('personal_access_client', 0)
                ->where('password_client', 0)
                ->exists();

            if (!$client){
                app()->abort(403);
            }
        }
        else {
            app()->abort(403);
        }

        $this->validate($request, [
            'password' => 'required|min:8|max:50',
            'password_confirmation' => 'required|max:50|same:password',
            'email' => 'required|email|unique:users|max:35',
            'name' => 'required|max:20',
        ]);
    }
}
