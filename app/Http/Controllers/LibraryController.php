<?php

namespace App\Http\Controllers;

use App\Models\Book;

class LibraryController extends Controller
{
    public function index()
    {
        return view('library.index', ['books' => Book::latest()->paginate(10)]);
    }
}
