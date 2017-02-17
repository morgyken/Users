<?php

namespace Ignite\Users\Http\Controllers;

use Ignite\Users\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AndroidController extends Controller
{

    public function authenticateUser(Request $request)
    {
        $response["error"] = false;
        if (empty($request->username) || empty($request->password)) {
            $response["error"] = true;
            $response["error_msg"] = "Required parameters email or password is missing!";
        }
        $column = 'username';
        if (str_contains($request->username, '@')) {
            $column = 'email';
        }
        if (Auth::attempt([$column => $request->username, 'password' => $request->password])) {
            $response['user'] = User::with('profile')->where($column, $request->username)->get();
        } else {
            $response["error"] = true;
            $response["error_msg"] = "Login credentials are wrong. Please try again!";
        }

        return Response::json($response);
    }
}
