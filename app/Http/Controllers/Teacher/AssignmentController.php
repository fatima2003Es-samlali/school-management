<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $teacher = auth()->user()->teacher;
        $assignments = Assignment::with('schoolClass')
            ->where('teacher_id', optional($teacher)->id)
            ->latest()
            ->paginate(10);

        return view('teacher.assignments.index', compact('assignments'));
    }

    public function create()
    {
        return view('teacher.assignments.create', ['classes' => SchoolClass::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $teacher = auth()->user()->teacher;

        if (! $teacher) {
            return back()->with('error', 'Votre profil enseignant est introuvable.');
        }

        Assignment::create($this->validated($request) + ['teacher_id' => $teacher->id]);

        return redirect()->route('teacher.assignments.index')->with('success', 'Devoir ajoute avec succes.');
    }

    public function edit(Assignment $assignment)
    {
        $this->authorizeTeacher($assignment);

        return view('teacher.assignments.edit', [
            'assignment' => $assignment,
            'classes' => SchoolClass::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Assignment $assignment)
    {
        $this->authorizeTeacher($assignment);
        $assignment->update($this->validated($request));

        return redirect()->route('teacher.assignments.index')->with('success', 'Devoir modifie avec succes.');
    }

    public function destroy(Assignment $assignment)
    {
        $this->authorizeTeacher($assignment);
        $assignment->delete();

        return back()->with('success', 'Devoir supprime.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'class_id' => ['required', 'exists:classes,id'],
            'due_date' => ['required', 'date'],
            'file_link' => ['nullable', 'string', 'max:255'],
        ]);
    }

    private function authorizeTeacher(Assignment $assignment): void
    {
        abort_unless($assignment->teacher_id === optional(auth()->user()->teacher)->id, 403);
    }
}
