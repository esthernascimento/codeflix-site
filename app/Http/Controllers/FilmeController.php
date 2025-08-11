<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use Illuminate\Http\Request;

class FilmeController extends Controller
{
    public function index()
    {
        $filmes = \App\Models\Filme::all();
        return view('home', compact('filmes'));
    }
}
