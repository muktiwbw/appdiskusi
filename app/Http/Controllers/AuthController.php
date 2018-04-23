<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
    
    public function register(Request $request){
        
        // Menangkap variabel yang masuk
        $username = $request->username;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $password = $request->password;

        // Membuat user baru
        $user = new User;
        $user->username = $username;
        $user->email = $email;
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->password = bcrypt($password);
        $user->save();

        // Mengirimkan pesan sukses dan data user yang dibuat
        return response()->json([
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'created_at' => $user->created_at,
        ]);

    }
    
    public function login(Request $request){
        
        // Assign input ke variabel baru
        $username = $request->username;
        $password = $request->password;

        // Cek kecocokan username dan password
        // Jika tidak ada kecocokan, maka kembalikan response error
        if(!Auth::attempt([
            'username' => $username,
            'password' => $password,
        ])){
            // response error
            return response()->json([
                'message' => 'Autentikasi gagal'
            ]);
        }

        $user = Auth::user();

        // Update api token
        $user->api_token = strtolower(str_random(60));
        $user->save();

        // Kirim response ke client
        return response()->json([
            'id' => $user->id,
            'api_token' => $user->api_token,
        ]);

    }

}
