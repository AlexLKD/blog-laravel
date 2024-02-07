<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Articles;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->is('Articles')) {
            return view('articles.index');
        }
    
        $articles = Articles::all();
        return view('dashboard', compact('articles'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Valider les données envoyées par le formulaire
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:published,draft',
            'image' => 'required|image',
        ]);
            // Gérer le téléchargement de l'image si un fichier est téléchargé
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Enregistrer l'image dans le dossier "storage/app/public/images"
            $validated['image'] = $imagePath;
    }
    
        // Créer un nouvel article avec les données validées et lier à l'utilisateur actuel
        $request->user()->articles()->create($validated);
    
        // Rediriger l'utilisateur vers la page d'index des articles
        return redirect()->route('Articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Articles $articles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articles $articles)
    {
        return view('edit', compact('articles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Articles $articles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articles $articles)
    {
        //
    }
}
