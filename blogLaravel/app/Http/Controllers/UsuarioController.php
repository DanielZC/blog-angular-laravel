<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UsuarioController extends Controller
{
    private $model;

    public function __construct() 
    {
        $this->model = new Usuario();
    }

    public function crearUsuario(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'nombreCompleto' => ['required', 'min:6', 'max:50', 'string'],
            'usuario' => ['required', 'unique:usuarios'],
            'contrasena' => ['required', 'confirmed:_contrasena', Password::min(8)->numbers()->mixedCase()], 
            'contrasena_confirmation' => ['required']
        ]);

        if($validador->fails())
        {
            $response = array(
                'tipo' => 'error',
                'contenido' => $validador->errors()
            );

            return response()->json($response, 200);
        }

        $this->model->crearUsuario($request->all());

        $response = array(
            'tipo' => 'success',
            'contenido' => null
        );

        return response()->json($response, 200);
    }

    public function verificarUsuario(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'usuario' => ['required'],
            'contrasena' => ['required']
        ]);

        if($validador->fails())
        {
            $response = array(
                'tipo' => 'error',
                'contenido' => $validador->errors()
            );

            return response()->json($response, 200);
        }

        $this->model->crearUsuario($request->all());

        $response = array(
            'tipo' => 'success',
            'contenido' => null
        );
    }
}
