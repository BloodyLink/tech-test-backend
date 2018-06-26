<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    }
}
