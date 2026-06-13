<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['user', 'schoolClass'])->latest()->paginate(10);

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create', ['classes' => SchoolClass::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'student',
        ]);

        Student::create([
            'user_id' => $user->id,
            'class_id' => $data['class_id'] ?? null,
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Etudiant ajoute avec succes.');
    }

    public function edit(Student $student)
    {
        $student->load('user');

        return view('admin.students.edit', [
            'student' => $student,
            'classes' => SchoolClass::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $data = $this->validated($request, $student);

        $student->user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => filled($data['password'] ?? null) ? Hash::make($data['password']) : $student->user->password,
        ]);

        $student->update([
            'class_id' => $data['class_id'] ?? null,
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Etudiant modifie avec succes.');
    }

    public function destroy(Student $student)
    {
        $student->user->delete();

        return back()->with('success', 'Etudiant supprime.');
    }

    private function validated(Request $request, ?Student $student = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(optional($student)->user_id)],
            'password' => [$student ? 'nullable' : 'required', 'string', 'min:6'],
            'class_id' => ['nullable', 'exists:classes,id'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
