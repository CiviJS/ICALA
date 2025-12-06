<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use App\Models\Planilla;
use Exception;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    
    public function validar($request){
        $request->validate([
            'nombre' => 'required|string|max:30|alpha_spaces',
            'fechaNacimiento' => 'required|date|before_or_equal:today',
            'fechaIngreso' => 'required|date|before_or_equal:today',
           'telefono' => ['required', 'regex:/^\d{7,12}$/', 'integer'],


        ],[
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.alpha_spaces' => 'El nombre solo puede contener letras y espacios.',
            'fechaNacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fechaNacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'fechaNacimiento.before_or_equal' => 'La fecha de nacimiento no puede ser futura.',
             'fechaIngreso.date' => 'La fecha de ingreso debe ser una fecha válida.',
            'fechaIngreso.before_or_equal' => 'La fecha de ingreso no puede ser futura.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.regex' => 'El teléfono solo debe tener 12 dígitos.',
        ]
            
    );
    }
    public function store(Request $request)
    {   try{
        $this->validar($request);
        $usuario = new Usuario();
        $usuario->UUID = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $usuario->nombre = $request->input('nombre');
        $usuario->fechaNacimiento = $request->input('fechaNacimiento');
        $usuario->fechaIngreso = $request->input('fechaIngreso');
        $usuario->telefono = $request->input('telefono');
        $usuario->save();
        return redirect('/')->with('message', 'Usuario creado exitosamente.');
        }catch(\Exception){
            return redirect('/')->with('error','Algo salio mal');
    }
    }
    public function crear(){
        return view('usuario/crearUsuario');
    }
    public function editar($uuid){
        $usuario = Usuario::where('UUID', $uuid)->first();
        if(isset($usuario)){
        return view('usuario/editarUsuario', compact('usuario'));
        }
        return redirect('/')->with('error','Usuario No Existe');
    }
   public function update(Request $request, $uuid){
    try{
        $this->validar($request);
        $usuario = Usuario::where('UUID', $uuid)->first();
        $usuario->nombre = $request->input('nombre');
        $usuario->FechaNacimiento = $request->input('fechaNacimiento');
        $usuario->fechaIngreso = $request->input('fechaIngreso');
        $usuario->telefono = $request->input('telefono');
        $usuario->save();
        return redirect('/Usuario/editar/'.$uuid)->with('message', 'Usuario actualizado exitosamente.');
    }catch(\Exception){
        return redirect('/')->with('error','Algo salio mal');
    }

    }

    public function buscar(Request $request){
        $campo = $request->input('campo');
        $usuarios = Usuario::where('nombre', 'LIKE', "%$campo%")
                    ->orWhere('telefono', 'LIKE', "%$campo%")
                    ->orWhere('fechaNacimiento', 'LIKE', "%$campo%")
                    ->get();

         $usuarios->loadCount('planillas');
        $planilla = new Planilla();
        $totalPlanilla = Planilla::count();
        foreach($usuarios as $usuario){
            $usuario->NoAsistidas = $totalPlanilla - $usuario->planillas_count;
        }

        return view('home')->with( compact('usuarios')); 
    }
    public function eliminar($uuid){
        $usuario = Usuario::find($uuid);
        $usuario->delete();
        return redirect('/')->with('message', 'Usuario eliminado exitosamente.');
    }

}
