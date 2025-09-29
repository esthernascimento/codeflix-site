<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use Illuminate\Http\Request;

class FilmeController extends Controller
{
    // ... (Seus métodos existentes, como index() e os de API) ...

    public function index()
    {
        $filmes = \App\Models\Filme::all();
        return view('home', compact('filmes'));
    }

    public function indexApi()
    {
        
        $filmes = \App\Models\Filme::all();
        return $filmes;
    }

    public function create()
    {
        return view('cadastroFilme'); 
    }


    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'genero' => 'required|string|max:100',
            'imagem' => 'nullable|url|max:255',
            'classificacao' => 'required|integer|min:0|max:18',
        ]);

        Filme::create($request->all());
     
        return redirect()->route('filmes.index')->with('success', 'Filme cadastrado com sucesso!');
    }

    public function storeApi(Request $request){

        $filme = Filme::create([
            'titulo' => $request->titulo,
            'genero' => $request->genero,
            'imagem' => $request->imagem,
            'classificacao' => $request->classificacao,
        ]);
        
        // Retorna o filme recém-criado para a API
        return response()->json($filme, 201);
    }
}