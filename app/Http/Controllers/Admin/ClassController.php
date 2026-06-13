<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        return view('admin.classes.index', ['classes' => SchoolClass::latest()->paginate(10)]);
    }

    public function create()
    {
        return view('admin.classes.create');
    }

    public function store(Request $request)
    {
        SchoolClass::create($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'level' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]));

        return redirect()->route('admin.classes.index')->with('success', 'Classe ajoutee avec succes.');
    }

    public function edit(SchoolClass $class)
    {
        return view('admin.classes.edit', compact('class'));
    }

    public function update(Request $request, SchoolClass $class)
    {
        $class->update($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'level' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]));

        return redirect()->route('admin.classes.index')->with('success', 'Classe modifiee avec succes.');
    }

    public function destroy(SchoolClass $class)
    {
        $class->delete();

        return back()->with('success', 'Classe supprimee.');
    }
}
