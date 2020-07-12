<?php

namespace App\Http\Controllers\Educations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function index(Request $request)
    {
        $query = Photo::query();
        $query->when($request->search, function ($db, $searchQuery) {
            return $db->where('album_name', 'like', "%{$searchQuery}%")
                ->orWhere('description', 'like', "%{$searchQuery}%");
        });

        $photos = $query->paginate();

        return view('public.educations.photos.index', compact('photos'));
    }

    public function show(Photo $photo)
    {
        return view('public.educations.photos.show', compact('photo'));
    }
}
