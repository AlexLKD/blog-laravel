<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Récupérer les articles de l'utilisateur connecté
        $articles = $user->articles;

        // Passer les articles à la vue du tableau de bord
        return view('dashboard', ['articles' => $articles]);
    }
}
