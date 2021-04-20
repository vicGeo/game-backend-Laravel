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

    public function loginUser(Request $request){

        $email = $request->input('email');
        $password = $request->input('password');

        try{

            $validateUser = User::select('password')
            ->where('email', 'LIKE', $email)
            ->first();

            if(!$validateUser){
                return response()->json([
                    'error'=> "Email o contraseña incorrecta"
                ]);
            }

            $hashed = $validateUser->password;


            if(Hash::check($password, $hashed)){


                $length = 35;
                $token = bin2hex(random_bytes($length));


                User::where('email', $email)
                ->update(['token' => $token]);

                return User::where('email', 'LIKE', $email)
                ->get();

            }else{
                return response()->json([
                    'error' => "Email o contraseña incorrecta"
                ]);
            }
        }catch(QueryException $error){

            return response()->$error;
        }
    }
}
