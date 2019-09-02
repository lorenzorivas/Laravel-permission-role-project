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
		$galleries = Gallery::orderBy('id', 'DESC')->paginate(20);
        return view('task.gallery', compact('galleries', 'randomclass'));
	}

	public function store(Request $request)
    {
        $this->validate($request, [
        'picture' => 'required',
        ],
            [ 
                'picture.required' => 'Asigna un titulo!',
            ]);

    	$link = Gallery::create($request->all());

    	return back()->with('info', 'enlace agregado con exito');
    }
}
