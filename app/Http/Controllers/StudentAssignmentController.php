<?php

namespace App\Http\Controllers;

use App\Models\Assignment;

class StudentAssignmentController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student;

        $assignments = Assignment::with(['schoolClass', 'teacher.user'])
            ->where('class_id', optional($student)->class_id)
            ->orderBy('due_date')
            ->paginate(10);

        return view('student.assignments.index', compact('assignments'));
    }
}
