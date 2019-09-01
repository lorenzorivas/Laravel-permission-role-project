<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use Illuminate\Support\Arr;

class GalleryController extends Controller
{
    public function index()
	{
		$class = ['vertical','horizontal','big',''];

		$randomclass = Arr::random($class);
		$galleries = Gallery::orderBy('id', 'ASC')->paginate(20);
        return view('task.gallery', compact('galleries', 'randomclass'));
	}
}
