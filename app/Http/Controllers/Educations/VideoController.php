<?php

namespace App\Http\Controllers\Educations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('created_at', 'DESC')->paginate();

        return view('public.educations.videos.index', compact('videos'));
    }

    public function show(Video $video)
    {
        return view('public.educations.videos.show', compact('video'));
    }
}
