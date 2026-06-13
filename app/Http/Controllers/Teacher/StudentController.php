<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $classes = SchoolClass::orderBy('name')->get();
        $students = Student::with(['user', 'schoolClass'])
            ->when($request->class_id, fn ($query) => $query->where('class_id', $request->class_id))
            ->orderBy('class_id')
            ->paginate(10)
            ->withQueryString();

        return view('teacher.students.index', compact('students', 'classes'));
    }
}
