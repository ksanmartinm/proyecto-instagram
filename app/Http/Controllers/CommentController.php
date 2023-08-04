<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{

public function __construct(){
    $this->middleware('auth');
}    

public function save(Request $request)
{
    //Validacion
    $validate = $this->validate($request, [
        'image_id' => 'integer|required',
        'content' => 'string|required'
    ]);
    
    //Recoger datos
    $user = \Auth::user();
    $image_id = $request->input('image_id');
    $content = $request->input('content');

    //Asigno los valores a mi nuevo objeto a guardar
    $comment = new Comment();
    $comment->user_id = $user->id;
    $comment->image_id = $image_id;
    $comment->content = $content;

    //Guardar en la bd
    $comment->save();

    //Redireccion
    return redirect()->route('image.detail', ['id' => $image_id])
                    ->with([
                        'message' => 'Publicaste un comentarrio correctamente'
                    ]);
}

public function delete($id){
    // Conseguir datos del ususario logueado
    $user = \Auth::user();

    //Conseguir objeto del comentario
    $comment = Comment::find($id);
    
    if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id))
    {
        $comment->delete();

        //Redireccion
        return redirect()->route('image.detail', ['id' => $comment->image->id])
        ->with([
            'message' => 'Comentario eliminado correctamente'
        ]);

    }else{
        //Redireccion
        return redirect()->route('image.detail', ['id' => $comment->image->id])
        ->with([
            'message' => 'El Comentario no se ha eliminado!!'
        ]);
    }

    

   
}

}