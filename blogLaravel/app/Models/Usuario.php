<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuario extends Model
{
    use HasFactory;

    protected $tabla = 'usuarios';
    protected $fillable = ['nombreCompleto', 'usuario', 'contrasena'];

    public function selecionarUsuario()
    {
        $usuarios = DB::table($this->tabla)->select()->get();
        return $usuarios;
    }

    public function crearUsuario($usuario)
    {
        DB::table($this->tabla)->insert([
            'nombreCompleto' => $usuario['nombreCompleto'],
            'usuario' => $usuario['usuario'],
            'contrasena' => $usuario['contrasena'],
            'creado' => date('Y-m-d h:i:s')
        ]);
    }
}
