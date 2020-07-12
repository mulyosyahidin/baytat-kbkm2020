<?php

namespace App\Http\Controllers\Educations;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Video;
use App\Models\Article;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $photos = Photo::orderBy('created_at', 'DESC')->take(3)->get();
        $videos = Video::orderBy('created_at', 'DESC')->take(10)->get();
        $articles = Article::orderBy('created_at', 'DESC')->take(6)->get();

        return view('public.educations.index', compact('photos', 'videos', 'articles'));
    }
}
