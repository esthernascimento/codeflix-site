<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;


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
            'nome'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255'],
            'mensagem' => ['required', 'string', 'max:5000'],
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
            'nome'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'email', 'max:255'],
            'mensagem'      => ['required', 'string', 'max:5000'],
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
            'nome'     => ['sometimes', 'string', 'min:3', 'max:255'],
            'email'    => ['sometimes', 'email', 'max:255'],
            'mensagem' => ['sometimes', 'string', 'max:5000'],
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

    public function download()
    {
        $sql = 'select * from contato';

        $queryJson = DB::select($sql);

        // Nome do arquivo CSV
        $filename = 'contatos.csv';

        // Cabeçalho do arquivo

        $headers = [
            'Content-Type' => 'text/csv;charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        //Cabeçalho        

        $file = fopen('php://output', 'w');

        fclose($file);

        // Gera o arquivo CSV
        $callback = function () use ($queryJson) {

            $file = fopen('php://output', 'w');

            //Cabeçalho
            $colId = "ID";
            $colNome = mb_convert_encoding("Nome", "ISO-8859-1");
            $colEmail = "Email";
            $colMensagem = mb_convert_encoding("Mensagem", "ISO-8859-1");

            $escreve = fwrite($file, "$colId;$colNome;$colEmail;$colMensagem;");

            foreach ($queryJson as $d) {
                $data1 = $d->id;
                $data2 = mb_convert_encoding($d->nome, "ISO-8859-1");
                $data3 = $d->email;
                $data4 = mb_convert_encoding($d->mensagem, "ISO-8859-1");
                $escreve = fwrite($file, "\n$data1;$data2;$data3;$data4;");
            }
            fclose($file);
        };

        
        // Retorna o arquivo CSV para download
        return Response::stream($callback, 200, $headers);

    }
}
