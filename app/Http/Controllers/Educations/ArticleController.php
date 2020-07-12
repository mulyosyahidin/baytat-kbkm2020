<?php

namespace App\Http\Controllers\Educations;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'DESC')->paginate();

        return view('public.educations.articles.index', compact('articles'));
    }

    public function show(Article $article, $slug)
    {
        return view('public.educations.articles.show', compact('article'));
    }
}
