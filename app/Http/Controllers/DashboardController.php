<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Models\Contato;
use App\Models\User;
use App\Models\Membro;

class DashboardController extends Controller
{
    public function index()
    {
    
        $contatos = Contato::latest()->paginate(10);

        $totalComedia   = Filme::where('genero', 'Comédia')->count();
        $totalAcao      = Filme::where('genero', 'Ação')->count();
        $totalDrama     = Filme::where('genero', 'Drama')->count();
        $totalAnimacao  = Filme::where('genero', 'Animação')->count();

        $filmesComedia  = Filme::where('genero', 'Comédia')->orderBy('titulo')->get();
        $filmesAcao     = Filme::where('genero', 'Ação')->orderBy('titulo')->get();
        $filmesDrama    = Filme::where('genero', 'Drama')->orderBy('titulo')->get();
        $filmesAnimacao = Filme::where('genero', 'Animação')->orderBy('titulo')->get();

        $filmesCount   = Filme::count();
        $adminsCount   = User::where('is_admin', '1')->count();   
        $membrosCount = Membro::count();

        return view('auth.dashboard', compact(
            'contatos',
            'totalComedia','totalAcao','totalDrama','totalAnimacao',
            'filmesComedia','filmesAcao','filmesDrama','filmesAnimacao',
            'filmesCount','adminsCount','membrosCount'
        ));
    }
}
