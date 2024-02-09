<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $sortOrder = $request->input('sortOrder', 'desc');
    
        $articles = Articles::orderByRaw("CASE WHEN updated_at = created_at THEN created_at ELSE updated_at END $sortOrder")->get();
    
        return view('blog.index', compact('articles', 'sortOrder'));
    }
    
    
    
    
}
