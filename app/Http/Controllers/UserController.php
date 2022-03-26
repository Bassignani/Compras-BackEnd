<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;



class UserController extends Controller
{
    public function register(Request $request){ 
        $request->validate([
            'empresa_id' => 'integer',
            'name' => 'required|string|max:255',
            'secondname' => 'string|max:255',
            'lastname' => 'required|string|max:255',
            'dni' => 'required|string|max:255',
            'cuil' => 'string|max:255',
            'direccion' => 'string|max:255',
            'telefono' => 'string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);        
        $user = new User();
        $user->empresa_id = $request->empresa_id;
        $user->name = $request->name;
        $user->secondname = $request->secondname;
        $user->lastname = $request->lastname;
        $user->dni = $request->dni;
        $user->cuil = $request->cuil;
        $user->direccion = $request->direccion;
        $user->telefono = $request->telefono;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();     
        $data = array(
            'status'  => 'success',
            'code'    => 201,
            'message' => 'El usuario se ha creado correctamente',
        );   
       return response()->json($data);  
    }


    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|',
            'password' => 'required',
        ]);
        $user = User::where("email", "=", $request->email)->first();
        if (isset($user->id)) {
            if(Hash::check($request->password, $user->password)){
                $token = $user->createToken("auth_token")->plainTextToken;
                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Usuario logueado correctamente',
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                );
            }else{
                $data = array(
                    'status' => 'error',
                    'code' => 401,
                    'message' => 'Usuario o contraseña incorrecto',
                );
            }
        }else{
            $data = array(
                'status' => 'error',
                'code' => 401,
                'message' => 'Usuario no registrado',                
            );
        }
        return response()->json($data);
    }


    public function logout(){
        auth()->user()->tokens()->delete(); //El methodo funciona. Nose porque el error
        $data = array(
            'status' => 'success',
            'code' => 200,
            'message' => 'Cierre de sesion',
        );
        return response()->json($data);
    }


    public function userProfile(){
        $data = array(
            'status' => 'success',
            'code' => 200,
            'message' => 'Perfil de usuario',
            'data' => auth()->user(),                
        );
        return response()->json($data);
    }

    
    public function index(){
        $users = User::all();
        return response()->json($users);
    } 


    
    public function update(Request $request,$id){
        $request->validate([
            'empresa_id' => 'integer',
            'name' => 'required|string|max:255',
            'secondname' => 'string|max:255',
            'lastname' => 'required|string|max:255',
            'dni' => 'required|string|max:255',
            'cuil' => 'string|max:255',
            'direccion' => 'string|max:255',
            'telefono' => 'string|max:255',
        ]);
        // $user = new User(); 
        // $user = auth()->user();
        $user = User::find($id);
        unset($request->email);
        unset($request->password);
        unset($request->created_at);
        $user->empresa_id = $request->empresa_id;
        $user->name = $request->name;
        $user->secondname = $request->secondname;
        $user->lastname = $request->lastname;
        $user->dni = $request->dni;
        $user->cuil = $request->cuil;
        $user->direccion = $request->direccion;
        $user->telefono = $request->telefono;   
        $user->save();
        $data = array(
            'status' => 'success',
            'code' => 200,
            'message' => 'Usuario actualizado correctamente',                
        );
        return response()->json($data);        
    }


    public function edit(Request $request){
        $request->validate([
            'empresa_id' => 'integer',
            'name' => 'required|string|max:255',
            'secondname' => 'string|max:255',
            'lastname' => 'required|string|max:255',
            'dni' => 'required|string|max:255',
            'cuil' => 'string|max:255',
            'direccion' => 'string|max:255',
            'telefono' => 'string|max:255',
        ]);
        $user = new User(); 
        $user = auth()->user();
        unset($request->email);
        unset($request->password);
        unset($request->created_at);
        $user->empresa_id = $request->empresa_id;
        $user->name = $request->name;
        $user->secondname = $request->secondname;
        $user->lastname = $request->lastname;
        $user->dni = $request->dni;
        $user->cuil = $request->cuil;
        $user->direccion = $request->direccion;
        $user->telefono = $request->telefono;   
        $user->save();
        $data = array(
            'status' => 'success',
            'code' => 200,
            'message' => 'Usuario actualizado correctamente',                
        );
        return response()->json($data);        
    }

}
