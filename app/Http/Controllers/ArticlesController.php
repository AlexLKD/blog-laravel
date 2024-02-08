<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
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
    public function edit(Articles $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Articles $article)
    {
        // Validation des données
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'status' => 'required|in:published,draft',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Ajoutez les règles de validation appropriées pour l'image
    ]);

    // Vérifiez si une nouvelle image a été téléchargée
    if ($request->hasFile('image')) {
        // Supprimez l'ancienne image du stockage si elle existe
        if ($article->image) {
            Storage::delete($article->image);
        }

        // Enregistrez la nouvelle image téléchargée
        $validated['image'] = $request->file('image')->store('images', 'public');
    }

    // Mettre à jour les valeurs de l'article
    $article->update($validated);

    // Redirection vers la page de tableau de bord après la mise à jour
    return redirect()->route('dashboard')->with('success', 'Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articles $articles)
    {
        //
    }
}
