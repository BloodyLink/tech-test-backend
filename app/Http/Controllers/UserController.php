<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Validator;
use Auth;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        header("Access-Control-Allow-Origin: *");
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        header("Access-Control-Allow-Origin: *");
        //checkeamos si el usuario existe
        $userCheck = User::where('email', $request->email)->first();

        if ($userCheck) { //si existe, enviamos error.
            $response = [
                'resultMessage' => 'Usuario ya existe'
            ];
            $responseCode = 401;
        }else{//si no existe, lo creamos
            $user = new User;

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;

            $user->save();

            $response = [
                'resultMessage' => 'OK'
            ];
            $responseCode = 200;
        }


        return response(json_encode($response), $responseCode)
                ->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        header("Access-Control-Allow-Origin: *");
        $user = User::find($id);

        if (!$user) {
            $response = [
                'resultMessage' => 'Usuario no existe'
            ];
            $responseCode = 404;
        } else {
            $response = $user;
            $responseCode = 200;
        }

        return response($response, $responseCode)
                ->header('Content-Type', 'application/json');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        header("Access-Control-Allow-Origin: *");
        //checkeamos si user existe
        $user = User::find($id);

        if (!$user) {
            $response = [
                'resultMessage' => 'Usuario no existe'
            ];
            $responseCode = 404;
        }else{
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();
            $response = [
                'resultMessage' => 'Usuario editado correctamente'
            ];
            $responseCode = 200;
        }
        return response(json_encode($response), $responseCode)
                ->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        header("Access-Control-Allow-Origin: *");
        //checkeamos si existe
        $user = User::find($id);

        if(!$user){
            $response = [
                'resultMessage' => 'Usuario no existe.'
            ];
            $responseCode = 404;
        }else{
            User::destroy($id);
            $response = [
                'resultMessage' => 'Usuario eliminado.'
            ];
            $responseCode = 200;
        }
        return response(json_encode($response), $responseCode)
                ->header('Content-Type', 'application/json');
    }

    /**
     * LOGIN POR API
     */

    public function login(){ 
        header("Access-Control-Allow-Origin: *");
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success], 200); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    public function register(Request $request){ 
        header("Access-Control-Allow-Origin: *");
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'email' => 'required|email', 
            'role' => 'required',
            'password' => 'required'
        ]);

        //let's check if email exists
        $email = User::where('email', $request->email)->first();
        // dd($email);

        if ($email == NULL) {
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);            
            }
            $input = $request->all(); 
            $input['password'] = bcrypt($input['password']); 
            $user = User::create($input); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;
            return response()->json(['success'=>$success], 200);
        } else {
            return response()->json(['error'=>"InvalidEmail"], 401);
        }
    }   

    public function details(){ 
        $user = Auth::user(); 
        return response()->json(['success' => $user], 200   ); 
    } 
    
    public function logoutApi(){ 
        header("Access-Control-Allow-Origin: *");
        if (Auth::check()) {
        Auth::user()->AauthAcessToken()->delete();
        }
    }

}
