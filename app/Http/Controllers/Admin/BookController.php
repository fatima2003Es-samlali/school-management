<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return view('admin.books.index', ['books' => Book::latest()->paginate(10)]);
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        Book::create($this->validated($request));

        return redirect()->route('admin.books.index')->with('success', 'Livre ajoute avec succes.');
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $book->update($this->validated($request));

        return redirect()->route('admin.books.index')->with('success', 'Livre modifie avec succes.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return back()->with('success', 'Livre supprime.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'available' => ['nullable', 'boolean'],
        ]);

        $data['available'] = $request->boolean('available');

        return $data;
    }
}
