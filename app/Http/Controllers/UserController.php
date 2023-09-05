<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($search = null){
        if(!empty($search))
        {
            $users = User::where('nick', 'LIKE', '%'.$search.'%')
                            ->orWhere('name', 'LIKE', '%'.$search.'%')
                            ->orWhere('surname', 'LIKE', '%'.$search.'%')
                            ->orderBy('id', 'desc')
                            ->paginate(5);
        }else{
            $users = User::orderBy('id', 'desc')->paginate(5);
        }

        return view('user.index', [
            'users' => $users
        ]);
    }

    public function config(){
        return view('user.config');
    }

    public function update(Request $request)
    {
        $user = \Auth::user();
        $id = \Auth::user()->id;

        $validate = $this->validate($request, [
            'name' => 'required|string',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:usuario,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:usuario,email,'.$id

        ]);

        $nick = $request->input('nick');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');

        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //subir imagen
        $image_path = $request->file('image_path');

        if($image_path)
        {
            //poner nombre unico
            $image_path_name = time().$image_path->getClientOriginalName();
            //Guardar en la carpeta storage (storage/app/user)
            Storage::disk('user')->put($image_path_name,File::get($image_path));
            // Seteo el nombre de la imagen en el objeto
            $user->image = $image_path_name;
        }


        $user->update();

        return redirect()->route('config')->with(['message'=>'Usuario actualizado correctamente']);
    }

    public function GetImage($filename)
    {
        $file = Storage::disk('user')->get($filename);
        return new Response($file, 200);
    }

    public function profile($id){
        $user = User::find($id);
        return view('user.profile', [
            'user' => $user
        ]);
    }


}