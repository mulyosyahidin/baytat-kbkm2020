<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Validator;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()
            ->json(['data' => Slider::all()]);
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
            'picture' => 'required|max:5096|mimes:jpg,png,jpeg'
        ]);

        if ($validator->fails())
        {
            return response()
                ->json(['errors' => TRUE, 'responses' => $validator->errors()]);
        }

        $slider = new Slider;
        $slider->title = $request->title;
        $slider->link = $request->link;
        $slider->description = $request->description;
        $slider->save();

        $id = $slider->id;

        if ($request->hasFile('picture') && $request->file('picture')->isValid())
        {
            $slider->addMediaFromRequest('picture')
                ->toMediaCollection('slider_picture');
        }

        return response()
            ->json([
                'success' => TRUE,
                'id' => $id
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        $slider->picture_url = $slider->media[0]->getFullUrl();
        unset($slider->media);

        return $slider;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'picture' => 'nullable|mimes:jpg,png,jpeg|max:5096'
        ]);

        if ($validator->fails()) {
            return response()
                ->json(['errors' => TRUE, 'responses' => $validator->errors(), $request->all()]);
        }

        $slider->title = $request->title;
        $slider->link = $request->link;
        $slider->description = $request->description;
        
        $slider->save();

        if ($request->hasFile('picture') && $request->file('picture')->isValid())
        {
            $slider->media[0]->delete();
            $slider->addAllMediaFromRequest('picture')
                ->toMediaCollection('slider_picture');
        }

        return response()
            ->json(['success' => TRUE]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->media[0]->delete();
        $slider->delete();

        return response()
            ->json(['success' => TRUE]);
    }
}
