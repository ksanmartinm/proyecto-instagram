<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function config(){
        return view('user.config');
    }

    public function update(Request $request)
    {
        $id = \Auth::user()->id;
        $nick = $request->input('nick');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');

        var_dump($nick);
        die();
    }
}
