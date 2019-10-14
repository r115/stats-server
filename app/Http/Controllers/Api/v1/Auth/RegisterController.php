<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
     * @todo Use repositories for model manipulations.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
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
                return response()->json([
                    'message' => 'Access denied'
                ], 403);
            }
        }
        else {
            return response()->json([
                'message' => 'Access denied'
            ], 403);
        }

        $this->validate($request, [
            'password' => 'required|min:8|max:50',
            'password_confirmation' => 'required|max:50|same:password',
            'email' => 'required|email|unique:users|max:35',
            'name' => 'required|max:20',
        ]);

        //Create a new user
        $user = new User();
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->name = $request->get('name');
        $user->save();

        return response()->json($user,200);
    }
}
