<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Relation;
use App\Models\Photo;
use App\Models\Video;
use App\Models\Article;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = Slider::all();
        $relations = Relation::orderBy('created_at', 'DESC')->take(5)->get();
        $photos = Photo::orderBy('created_at', 'DESC')->take(3)->get();
        $videos = Video::orderBy('created_at', 'DESC')->take(10)->get();
        $articles = Article::orderBy('created_at', 'DESC')->take(6)->get();

        return view('public.home', compact('sliders', 'relations', 'photos', 'videos', 'articles'));
    }
}
