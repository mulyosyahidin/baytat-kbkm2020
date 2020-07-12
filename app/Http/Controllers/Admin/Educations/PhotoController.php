<?php

namespace App\Http\Controllers\Admin\Educations;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::orderBy('created_at', 'DESC')->paginate();

        return view('admin.educations.photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.educations.photos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'album_name' => 'required'
        ]);

        $photo = new Photo;

        $photo->album_name = $request->album_name;
        $photo->description = $request->description;

        $photo->save();

        if ($request->hasFile('photos'))
        {
            //https://stackoverflow.com/questions/57794682/laravel-spatie-medialibrary-upload-multiple-images-through-rest-api
            
            $files = $photo->addMultipleMediaFromRequest(['photos'])
                ->each(function ($file) {
                    $file->toMediaCollection('photo_album');
                });
        }

        return redirect()
            ->back()
            ->withSuccess('Berhasil menambahkan foto');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        return view('admin.educations.photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        return view('admin.educations.photos.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        $request->validate([
            'album_name' => 'required'
        ]);

        $photo->album_name = $request->album_name;
        $photo->description = $request->description;

        $photo->save();

        if ($request->hasFile('photos'))
        {
            //https://stackoverflow.com/questions/57794682/laravel-spatie-medialibrary-upload-multiple-images-through-rest-api
            
            $files = $photo->addMultipleMediaFromRequest(['photos'])
                ->each(function ($file) {
                    $file->toMediaCollection('photo_album');
                });
        }

        return redirect()
            ->to(route('photos.show', $photo->id))
            ->withSuccess('Berhasil memperbarui data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        if (count($photo->media) > 0) {
            foreach ($photo->media as $media) {
                $media->delete();
            }
        }

        $photo->delete();

        return redirect()
            ->to(route('photos.index'))
            ->withSuccess('Berhasil menghapus album foto');
    }
}
