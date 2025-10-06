<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Filme;
use App\Models\Contato;
use App\Models\User;
use App\Models\Membro;

class DashboardController extends Controller
{ 
    public function index(Request $request)
    { 
        $sort = $request->query('sort', 'nome');
        $direction = $request->query('direction', 'asc');
 
        if ($sort === 'nome') {
            $contatos = Contato::orderBy($sort, $direction)->paginate(10);
        } else {
            $contatos = Contato::latest()->paginate(10);
            
        }
 
        $generos = collect([
            ['nome' => 'Comédia', 'total' => Filme::where('genero', 'Comédia')->count()],
            ['nome' => 'Ação', 'total' => Filme::where('genero', 'Ação')->count()],
            ['nome' => 'Drama', 'total' => Filme::where('genero', 'Drama')->count()],
            ['nome' => 'Animação', 'total' => Filme::where('genero', 'Animação')->count()],
        ]);
 
        if ($sort === 'total') {
            if ($direction === 'asc') {
                $generos = $generos->sortBy('total');
            } else {
                $generos = $generos->sortByDesc('total');
            }
        }
         
        $filmesCount = Filme::count();
        $adminsCount = User::where('is_admin', '1')->count();
        $membrosCount = Membro::count();

        $totalL = Filme::where('classificacao', 'L')->count();
        $total10 = Filme::where('classificacao', '10')->count();
        $total12 = Filme::where('classificacao', '12')->count();
        $total16 = Filme::where('classificacao', '16')->count();
 
        return view('auth.dashboard', [

            'contatos' => $contatos,
            'generos' => $generos,
            'sort' => $sort,
            'direction' => $direction,

            'filmesCount' => $filmesCount,
            'adminsCount' => $adminsCount,
            'membrosCount' => $membrosCount,
            'totalL' => $totalL,
            'total10' => $total10,
            'total12' => $total12,
            'total16' => $total16,

         
            'totalComedia' => $generos->firstWhere('nome', 'Comédia')['total'],
            'totalAcao' => $generos->firstWhere('nome', 'Ação')['total'],
            'totalDrama' => $generos->firstWhere('nome', 'Drama')['total'],
            'totalAnimacao' => $generos->firstWhere('nome', 'Animação')['total'],
        ]);
    }
}