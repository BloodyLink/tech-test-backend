<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RolesController extends Controller
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
        //checkeamos si el rol existe
        $roleCheck = Role::where('name', $request->name)->first();

        if ($roleCheck) { //si existe, enviamos error.
            $response = [
                'resultMessage' => 'Rol ya existe'
            ];
            $responseCode = 401;
        }else{//si no existe, lo creamos
            $role = new Role;

            $role->name = $request->name;

            $role->save();

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
        $role = Role::find($id);

        if (!$role) {
            $response = [
                'resultMessage' => 'Rol no existe'
            ];
            $responseCode = 404;
        } else {
            $response = $role;
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
        $role = Role::find($id);

        if (!$role) {
            $response = [
                'resultMessage' => 'Rol no existe'
            ];
            $responseCode = 404;
        }else{
            $role->name = $request->name;
            
            $role->save();
            $response = [
                'resultMessage' => 'Rol editado correctamente'
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
        $role = Role::find($id);

        if(!$role){
            $response = [
                'resultMessage' => 'Rol no existe.'
            ];
            $responseCode = 404;
        }else{
            Role::destroy($id);
            $response = [
                'resultMessage' => 'Rol eliminado.'
            ];
            $responseCode = 200;
        }
    }
}
