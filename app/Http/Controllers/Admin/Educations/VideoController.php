<?php

namespace App\Http\Controllers\Admin\Educations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        return view('admin.educations.videos');
    }
}
