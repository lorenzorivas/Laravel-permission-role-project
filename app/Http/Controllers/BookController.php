<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    public function index(Request $request)
    {
    	$books = Book::orderBy('id', 'ASC')->where('published', true)->paginate(15);

        return view('web.book.index',compact('books'));
    }

    public function show($slug)
    {
        $book = Book::where('slug', $slug)->first();
        if($book == false){
            abort (404);
        } 
        else {
            return view('web.book.show', compact('book', 'comments'));
        }
    }
}
