<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

use App\Models\User;


class UserController extends Controller
{

    public function registerUser(Request $request) {

        $userName = $request -> input('userName');
        $password = $request -> input('password');
        $email = $request -> input('email');
        $steamUsername = $request -> input('steamUsername');

        $password = Hash::make($password);

        try {

            return User::create([
                'userName' => $userName,
                'password' => $password,
                'email' => $email,
                'steamUsername' => $steamUsername
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
                ->update(['api_token' => $token]);

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

    public function logoutUser(Request $request){

        $email = $request->input('email');

        try{

            return User::where('email', '=', $email)
            ->update(['token' => null]);

        }catch(QueryException $error){
            return $error;
        }
    }

    public function allUsers(){

        try{
            return User::all();

        }catch(QueryException $error){
            return $error;
        }
    }

    public function updateUser(Request $request, $id){


        $userName = $request -> input('userName');
        $password = $request -> input('password');
        $email = $request -> input('email');
        $steamUsername = $request -> input('steamUsername');

        $password = Hash::make($password);

        try{
            return User::where('id', '=', $id)->update([
                'userName' => $userName, 
                'password' => $password, 
                'email' => $email,
                'steamUsername' => $steamUsername
            ]); 
        } catch(QueryException $error) {
            return $error;
        }
    }

    public function destroy(Request $request, $id){

        try {
            return User::where('id', '=', $id) -> delete();
        } catch (QueryException $error) {
            return $error;
        }

    }

    public function findUserById(Request $request, $id){
        
        try {
            return User::where('id', '=', $id) -> get();
        } catch (QueryException $error) {
            return $error;
        }
    }

}
