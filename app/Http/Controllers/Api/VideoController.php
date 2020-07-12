<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use Validator;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()
            ->json(['data' => VIdeo::orderBy('created_at', 'DESC')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'link' => 'required'
        ]);

        if ($validator->fails()) {
            return response()
                ->json(['errors' => TRUE, 'responses' => $validator->errors()]);
        }

        $link = $request->link;
        $id = explode('=', $link)[1];

        $video = new Video;
        $video->title = $request->title;
        $video->video_id = $id;
        $video->description = $request->description;
        $video->save();

        return response()
            ->json(['success' => TRUE]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::findOrFail($id);

        return $video;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'video_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()
                ->json(['errors' => TRUE, 'responses' => $validator->errors(), 'requests' => $request]);
        }

        $link = $request->video_id;;
        $id = explode('=', $link)[1];

        $video->title = $request->title;
        $video->video_id = $id;
        $video->description = $request->description;
        $video->save();

        return response()
            ->json(['success' => TRUE]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return response()
            ->json(['success' => TRUE]);
    }
}
