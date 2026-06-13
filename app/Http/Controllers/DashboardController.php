<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Book;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin(Request $request)
    {
        $classFilter = $request->query('class_id');
        $categoryFilter = $request->query('category');

        $studentsByClass = SchoolClass::withCount('students')
            ->when($classFilter, fn ($query) => $query->where('id', $classFilter))
            ->orderBy('name')
            ->get();

        $booksByCategory = Book::selectRaw("COALESCE(NULLIF(category, ''), 'Uncategorized') as label, COUNT(*) as total")
            ->when($categoryFilter, function ($query) use ($categoryFilter) {
                if ($categoryFilter === 'Uncategorized') {
                    $query->where(function ($subQuery) {
                        $subQuery->whereNull('category')->orWhere('category', '');
                    });
                } else {
                    $query->where('category', $categoryFilter);
                }
            })
            ->groupBy(DB::raw("COALESCE(NULLIF(category, ''), 'Uncategorized')"))
            ->orderBy('label')
            ->get();

        return view('dashboards.admin', [
            'classesCount' => SchoolClass::count(),
            'teachersCount' => Teacher::count(),
            'studentsCount' => Student::count(),
            'booksCount' => Book::count(),
            'classes' => SchoolClass::orderBy('name')->get(['id', 'name']),
            'bookCategories' => Book::selectRaw("COALESCE(NULLIF(category, ''), 'Uncategorized') as label")
                ->groupBy(DB::raw("COALESCE(NULLIF(category, ''), 'Uncategorized')"))
                ->orderBy('label')
                ->pluck('label'),
            'selectedClass' => $classFilter,
            'selectedCategory' => $categoryFilter,
            'studentsByClassLabels' => $studentsByClass->pluck('name'),
            'studentsByClassData' => $studentsByClass->pluck('students_count'),
            'booksByCategoryLabels' => $booksByCategory->pluck('label'),
            'booksByCategoryData' => $booksByCategory->pluck('total'),
        ]);
    }

    public function teacher(Request $request)
    {
        $teacher = auth()->user()->teacher;
        $classIds = $teacher && $teacher->class_id ? [$teacher->class_id] : [];
        $studentClassFilter = $request->query('student_class_id');
        $assignmentClassFilter = $request->query('assignment_class_id');

        $studentsPerClass = SchoolClass::withCount('students')
            ->whereIn('id', $classIds)
            ->when($studentClassFilter, fn ($query) => $query->where('id', $studentClassFilter))
            ->orderBy('name')
            ->get();

        $assignmentsByClass = Assignment::query()
            ->join('classes', 'assignments.class_id', '=', 'classes.id')
            ->selectRaw('classes.name as label, COUNT(assignments.id) as total')
            ->where('teacher_id', optional($teacher)->id)
            ->when($assignmentClassFilter, fn ($query) => $query->where('assignments.class_id', $assignmentClassFilter))
            ->groupBy('classes.id', 'classes.name')
            ->orderBy('classes.name')
            ->get();

        return view('dashboards.teacher', [
            'studentsCount' => Student::whereIn('class_id', $classIds)->count(),
            'assignmentsCount' => Assignment::where('teacher_id', optional($teacher)->id)->count(),
            'booksCount' => Book::count(),
            'teacherClasses' => SchoolClass::whereIn('id', $classIds)->orderBy('name')->get(['id', 'name']),
            'assignmentClasses' => SchoolClass::whereIn(
                'id',
                Assignment::where('teacher_id', optional($teacher)->id)->select('class_id')
            )->orderBy('name')->get(['id', 'name']),
            'selectedStudentClass' => $studentClassFilter,
            'selectedAssignmentClass' => $assignmentClassFilter,
            'studentsPerClassLabels' => $studentsPerClass->pluck('name'),
            'studentsPerClassData' => $studentsPerClass->pluck('students_count'),
            'assignmentsByClassLabels' => $assignmentsByClass->pluck('label'),
            'assignmentsByClassData' => $assignmentsByClass->pluck('total'),
        ]);
    }

    public function student(Request $request)
    {
        $student = auth()->user()->student()->with('schoolClass.teachers.user')->first();
        $classId = optional($student)->class_id;
        $studentClass = optional($student)->schoolClass;
        $classTeachers = $studentClass ? $studentClass->teachers : collect();
        $devoirFilter = $request->query('devoir_status', 'all');
        $assignmentsChartQuery = Assignment::where('class_id', $classId);

        if ($devoirFilter === 'pending') {
            $assignmentsChartQuery->whereDate('due_date', '>=', today());
        }

        $assignmentsByDueDate = $assignmentsChartQuery
            ->selectRaw('due_date as label, COUNT(*) as total')
            ->groupBy('due_date')
            ->orderBy('due_date')
            ->get();

        return view('dashboards.student', [
            'assignmentsCount' => Assignment::where('class_id', $classId)->count(),
            'booksCount' => Book::count(),
            'studentClass' => $studentClass,
            'classTeachers' => $classTeachers,
            'selectedDevoirStatus' => $devoirFilter,
            'assignmentsByDueDateLabels' => $assignmentsByDueDate->pluck('label'),
            'assignmentsByDueDateData' => $assignmentsByDueDate->pluck('total'),
        ]);
    }
}
