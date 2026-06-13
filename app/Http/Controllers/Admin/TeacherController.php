<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with(['user', 'schoolClass'])->latest()->paginate(10);

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create', ['classes' => SchoolClass::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'teacher',
        ]);

        Teacher::create([
            'user_id' => $user->id,
            'class_id' => $data['class_id'] ?? null,
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Enseignant ajoute avec succes.');
    }

    public function edit(Teacher $teacher)
    {
        $teacher->load('user');

        return view('admin.teachers.edit', [
            'teacher' => $teacher,
            'classes' => SchoolClass::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Teacher $teacher)
    {
        $data = $this->validated($request, $teacher);

        $teacher->user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => filled($data['password'] ?? null) ? Hash::make($data['password']) : $teacher->user->password,
        ]);

        $teacher->update([
            'class_id' => $data['class_id'] ?? null,
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Enseignant modifie avec succes.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->user->delete();

        return back()->with('success', 'Enseignant supprime.');
    }

    private function validated(Request $request, ?Teacher $teacher = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(optional($teacher)->user_id)],
            'password' => [$teacher ? 'nullable' : 'required', 'string', 'min:6'],
            'class_id' => ['nullable', 'exists:classes,id'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
