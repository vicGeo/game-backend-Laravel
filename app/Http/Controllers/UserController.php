<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

use App\Models\User;


class UserController extends Controller
{

    //Registro usuario
    public function registerUser(Request $request) {

        $userName = $request -> input('userName');
        $password = $request -> input('password');
        $email = $request -> input('email');

        $password = Hash::make($password);

        try {

            return User::create([
                'userName' => $userName,
                'password' => $password,
                'email' => $email
            ]);

        } catch (QueryException $error) {


            $eCode = $error -> errorInfo[1];

            if($eCode == 1062) {
                return response()-> json([
                    'error' => "Usuario registrado anteriormente"
                ]);
            }
        }
    }

    // //Login

    // public function loginUser(Request $request){

    //     $nickName = $request->input('nickName');
    //     $password = $request->input('password');

    //     try{

    //         $validatePlayer = Player::select('password')
    //         ->where('nickName', 'LIKE', $nickName)
    //         ->first();

    //         if(!$validatePlayer){
    //             return response()->json([
    //                 'error'=> "Username o password incorrecto"
    //             ]);
    //         }

    //         $hashed = $validatePlayer->password;


    //         if(Hash::check($password, $hashed)){


    //             $length = 35;
    //             $token = bin2hex(random_bytes($length));


    //             User::where('UserName', $userName)
    //             ->update(['token' => $token]);

    //             return User::where('UserName', 'LIKE', $userName)
    //             ->get();

    //         }else{
    //             return response()->json([
    //                 'error' => "Username o password incorrecto"
    //             ]);
    //         }
    //     }catch(QueryException $error){

    //         return response()->$error;
    //     }
    // }
}
