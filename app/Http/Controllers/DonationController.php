<?php

namespace App\Http\Controllers;

use App\Models\Relation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $relations = Relation::orderBy('created_at', 'DESC')->paginate();

        return view('public.donations.index', compact('relations'));
    }

    public function show(Relation $relation, $slug)
    {
        abort(202, 'Masih Dalam Pengembangan...');
    }
}
