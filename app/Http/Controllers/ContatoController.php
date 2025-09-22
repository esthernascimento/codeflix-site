<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{

    public function index()
    {
        // mais recentes primeiro + paginacao
        $contatos = Contato::latest()->paginate(10);
        return view('contato', compact('contatos'));
    }


    public function listarContatos()
    {
        $contatos = Contato::latest()->paginate(10);
        return view('auth.dashboard', compact('contatos'));
    }

    public function indexApi()
    {
        $contatos = Contato::latest()->get();
        return response()->json($contatos, 200);
    }


    public function storeApi(Request $request)
    {
        $data = $request->validate([
            'nome'     => ['required','string','max:255'],
            'email'    => ['required','email','max:255'],
            'mensagem' => ['required','string','max:5000'],
        ]);

        $contato = Contato::create($data);

        return response()->json([
            'message' => 'Contato criado com sucesso',
            'contato' => $contato,
        ], 201);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'          => ['required','string','max:255'],
            'email'         => ['required','email','max:255'],
            'mensagem'      => ['required','string','max:5000'],
            'caminho_foto'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);
        $path = '';
        if ($request->File('caminho_foto')) {
            $path = $request->file('caminho_foto')->store('images', 'public');
        }
        $data['caminho_foto'] = $path;

        Contato::create($data);

        return redirect()
            ->route('contatos.index')
            ->with('success', 'Contato enviado com sucesso!');
    }


    public function updateApi(Request $request, string $id)
    {
        $validarDados = $request->validate([
            'nome'     => ['sometimes','string','min:3','max:255'],
            'email'    => ['sometimes','email','max:255'],
            'mensagem' => ['sometimes','string','max:5000'],
        ]);

        $contato = Contato::findOrFail($id);
        $contato->update($validarDados);

        return response()->json([
            'message' => 'Contato alterado com sucesso',
            'contato' => $contato,
        ], 200);
    }


    public function destroyApi(string $id)
    {
        $contato = Contato::findOrFail($id);
        $contato->delete();

        return response()->json([
            'message' => 'Contato excluído',
        ], 200);
    }


    public function countContato()
    {
        return response()->json([
            'count' => Contato::count(),
        ], 200);
    }
}
