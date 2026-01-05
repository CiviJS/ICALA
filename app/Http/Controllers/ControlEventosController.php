<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControlEventosController extends Controller
{
    public function index()
    {
        return view('eventos/verEventos');

    }

    public function crear()
    {
        return view('eventos/crearEvento');

    }
}
