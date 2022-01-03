<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use App\User; 
use App\Topic; 
use App\Result; 

class FiltrosController extends Controller
{
    //Listar usuarios por filtro
    public function usuariosfiltro(Request $request)
    {
        $filtrar = $request->all();
        $usuarios = User::where('status', $filtrar['filtro'])->orderBy('id', 'DESC')->paginate(10);

        if($filtrar['filtro'] == "0") {
            $title = "Listando usuários - Inativos";
        } else {
            $title = "Listando usuarios - Ativos";
        }

        return view('cms.usuarios.index', compact('title', 'usuarios'));
    }

    //Listar usuarios por nome
    public function usuariosbusca(Request $request)
    {
        $buscar = $request->all();
        $usuarios = User::where('name', 'like', '%'.$buscar['busca'].'%')->paginate(10);
        
        $title = "Listando usuários - Resultado por: ".$buscar['busca'];
        return view('cms.usuarios.index', compact('title', 'usuarios'));
    }

    //Listar topicos por filtro
    public function topicsfiltro(Request $request){
        $filtrar = $request->all();
        $itens = Topic::where('id_pai', $filtrar['filtro'])->orderBy('id', 'DESC')->paginate(20);
        $itens_filtros = Topic::all();
        $title = "Listando topicos - id pai : ".$request->filtro;        
        return view('cms.topics.index', compact('title', 'itens', 'itens_filtros'));
    }   

    //Listar topicos por nome
    public function topicsbusca(Request $request){
        $buscar = $request->all();
        $itens = Topic::where('title', 'like', '%'.$buscar['busca'].'%')
                        ->orWhere('subtitle', 'like', '%'.$buscar['busca'].'%')
                        ->orWhere('text', 'like', '%'.$buscar['busca'].'%') 
                        ->paginate(20); 
        $itens_filtros = Topic::all();
        $title = "Listando topicos - Resultado por: ".$buscar['busca'];
        return view('cms.topics.index', compact('title', 'itens', 'itens_filtros'));
    }

    //Listar resultado por email,nome,phone
    public function resultsbusca(Request $request){
        $buscar = $request->all();
        $itens = Result::where('name', 'like', '%'.$buscar['busca'].'%')
                        ->orWhere('phone', 'like', '%'.$buscar['busca'].'%')
                        ->orWhere('email', 'like', '%'.$buscar['busca'].'%')
                        ->paginate(20); 
        $title = "Listando resultados - Resultado por: ".$buscar['busca'];
        return view('cms.results.index', compact('title', 'itens'));
    }
} 