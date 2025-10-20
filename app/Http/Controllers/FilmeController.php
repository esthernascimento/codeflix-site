<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function storeApi(Request $request)
    {

        $filme = Filme::create([
            'titulo' => $request->titulo,
            'genero' => $request->genero,
            'imagem' => $request->imagem,
            'classificacao' => $request->classificacao,
        ]);


        return response()->json($filme, 201);
    }

    public function download()
    {
        $sql = 'select * from filmes';

        $queryJson = DB::select($sql);

        // Nome do arquivo CSV
        $filename = 'filmes.csv';

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
            $colTitulo = mb_convert_encoding("Titulo", "ISO-8859-1");
            $colGenero = mb_convert_encoding("Genero", "ISO-8859-1");
            $colImagem = "Imagem";
            $colClassificacao = "Classificacao";

            $escreve = fwrite($file, "$colId;$colTitulo;$colGenero;$colImagem;$colClassificacao;");

            foreach ($queryJson as $d) {
                $data1 = $d->id;
                $data2 = mb_convert_encoding($d->titulo, "ISO-8859-1");
                $data3 = mb_convert_encoding($d->genero, "ISO-8859-1");
                $data4 = $d->imagem;
                $data5 = $d->classificacao;
                $escreve = fwrite($file, "\n$data1;$data2;$data3;$data4;$data5;");
            }
            fclose($file);
        };

        // Retorna o arquivo CSV para download
        return Response::stream($callback, 200, $headers);
    } //fim da função download

    public function downloadPdf()
    {

        $filmes = Filme::all();

        $dados = compact('filmes');

        $pdf = PDF::loadView('filme_pdf', $dados);

        return $pdf->download('documento.pdf'); // Faz o download do PDF

        // return $pdf->stream('documento.pdf'); // Exibe o PDF no navegador
    }
}
