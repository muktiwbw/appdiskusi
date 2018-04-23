<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Question;

class UserController extends Controller
{
    
    public function info(Request $request){

        // Assign input ke variabel baru
        $user_id = $request->user_id;

        // Cari user dengan id yang diinginkan
        $user = User::find($user_id);

        return response()->json([
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'name' => $user->first_name." ".$user->last_name,
            'created_at' => $user->created_at
        ]);

    }
    
    public function questions(Request $request){

        // Assign input ke variabel baru
        $user_id = $request->user_id;

        // Cari question sesuai dengan user_id yang masuk
        $questions = Question::where('user_id', $user_id)->get();

        // Kirim response
        return response()->json($questions);

    }

}
