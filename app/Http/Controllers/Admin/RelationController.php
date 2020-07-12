<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Relation;
use App\Models\Relation_prestation;
use App\Models\Relation_prestations;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relations = Relation::orderBy('created_at', 'DESC')->paginate(25);

        return view('admin.relations.index', compact('relations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.relations.create');
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
            'name' => 'required',
            'picture.*' => 'nullable|mimes:jpg,jpeg,png|max:5096'
        ]);

        $relation = new Relation();

        $relation->name = $request->name;
        $relation->slug = Str::slug($request->name);
        $relation->description = $request->description;
        $relation->address = $request->address;
        $relation->contact = $request->contact;

        $relation->save();
        $relation_id = $relation->id;

        $relation->addMultipleMediaFromRequest(['pictures'])
            ->each(function ($file) {
                $file->toMediaCollection('relation_pictures');
            });

        $prestations = $request->prestation;
        $n = 0;
        $relationPrestations = [];

        if (is_array($prestations) && count($prestations) > 0) {
            foreach ($prestations as $prestation) {
                $relationPrestations[$n] = $prestation;
                $relationPrestations[$n]['relation_id'] = $relation_id;

                if ($relationPrestations[$n]['event_name'] == '') {
                    unset($relationPrestations[$n]);
                }

                $n++;
            }

            Relation_prestation::insert($relationPrestations);
        }

        return redirect()
            ->back()
            ->withSuccess('Data sanggar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Relation  $relation
     * @return \Illuminate\Http\Response
     */
    public function show(Relation $relation)
    {
        return view('admin.relations.show', compact('relation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Relation  $relation
     * @return \Illuminate\Http\Response
     */
    public function edit(Relation $relation)
    {
        return view('admin.relations.edit', compact('relation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Relation  $relation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Relation $relation)
    {
        $request->validate([
            'name' => 'required',
            'picture' => 'nullable|mimes:jpg,jpeg,png|max:5096'
        ]);

        $relation->name = $request->name;
        $relation->address = $request->address;
        $relation->description = $request->description;
        $relation->contact = $request->contact;

        $relation->save();

        if ($request->hasFile('picture') && $request->file('picture')->isValid())
        {
            $relation->media[0]->delete();

            $relation->addMediaFromRequest('picture')
                ->toMediaCollection('sanggar_picture');
        }

        $addPrestations = $request->prestation;
        $prestations = [];
        $n = 0;

        if (is_array($addPrestations) && count($addPrestations) > 0)
        {
            foreach ($addPrestations as $prestation)
            {
                $prestations[$n] = $prestation;
                $prestations[$n]['relation_id'] = $relation->id;

                if ($prestations[$n]['event_name'] == '')
                {
                    unset($prestations[$n]);
                }

                $n++;
            }

            Relation_prestation::insert($prestations);
        }

        $update = $request->edit;
        if (is_array($update) && count($update) > 0)
        {
            foreach ($update as $relation_id => $newRelationData)
            {
                $relation_prestation = Relation_prestation::findOrFail($relation_id);

                $relation_prestation->event_name = $newRelationData['event_name'];
                $relation_prestation->organizer = $newRelationData['organizer'];
                $relation_prestation->year = $newRelationData['year'];
                $relation_prestation->description = $newRelationData['description'];

                $relation_prestation->save();
            }
        }

        $delete = $request->do_delete;
        if ($delete)
        {
            $del = $request->delete;
            if (is_array($del) && count($del) > 0)
            {
                foreach ($del as $relation_id => $val)
                {
                    $deleteRelation = Relation_prestation::findOrFail($relation_id);
                    $deleteRelation->delete();
                }
            }
        }

        return redirect()
            ->to(route('relations.show', $relation->id))
            ->withSuccess('Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Relation  $relation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Relation $relation)
    {
        if (count($relation->media) > 0) {
            foreach ($relation->media as $media) {
                $media->delete();
            }
        }

        $relation->delete();

        return redirect()
            ->to(route('relations.index'))
            ->withSuccess('Berhasil menghapus data sanggar relasi');
    }
}
