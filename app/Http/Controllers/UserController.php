<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Transformers\UserTransformer;
use App\User;

class UserController extends Controller
{

    //USER ALL
    public function user(User $user)
    {
        // return $request;
        return $user = $user->find(Auth::user()->id);

        // return $data = fractal()
        //         ->collection($user)
        //         ->transformWith(New UserTransformer)
        //         ->toArray();

        // return response()->json($data, 201);
    }




}
