<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\StoreCurso;

class CursoController extends Controller
{
    public function index(){
        $cursos = Curso::orderBy('id', 'desc')->paginate();
        //return $cursos;
        return view('cursos.index', compact('cursos'));
    }

    public function create(){
        return view('cursos.create');
    }

    public function store(StoreCurso $request){

        /*$curso = new Curso();

        $curso->name = $request->name;
        $curso->descripcion = $request->descripcion;
        $curso->categoria = $request->categoria;

        $curso->save(); */

        $slug = Str::slug($request->name, '-');
        $curso = Curso::create($request->all() + ['slug' => $slug]);

        return redirect()->route('cursos.show', $curso);
    }

    public function show(Curso $curso){
        /*
        if($categoria){
            return "Bienvenido al curso: $curso, de la categoría $categoria";
        } else{
            return "Bienvenido al curso: $curso";
        }
        */

        return view('cursos.show', compact('curso'));
    }

    public function edit(Curso $curso){
        return view('cursos.edit', compact('curso'));
    }

    public function update(Request $request, Curso $curso){

        $request->validate([
            'name' => 'required',
            'descripcion' => 'required',
            'categoria' => 'required'
        ]);

        /*
        $curso->name = $request->name;
        $curso->categoria = $request->categoria;
        $curso->descripcion = $request->descripcion;

        $curso->save();
        */

        $slug = Str::slug($request->name, '-');
        $curso->update($request->all() + ['slug' => $slug]);

        return redirect()->route('cursos.show', $curso);

    }

    public function destroy(Curso $curso){
        $curso->delete();

        return redirect()->route('cursos.index');
    }
}
