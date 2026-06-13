<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Book;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $classA = SchoolClass::create([
            'name' => 'Classe A',
            'level' => '1ere annee',
            'description' => 'Classe principale pour les nouveaux etudiants.',
        ]);

        $classB = SchoolClass::create([
            'name' => 'Classe B',
            'level' => '2eme annee',
            'description' => 'Classe avancee.',
        ]);

        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $teacherUser = User::create([
            'name' => 'Professeur Demo',
            'email' => 'teacher@example.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        $teacher = Teacher::create([
            'user_id' => $teacherUser->id,
            'class_id' => $classA->id,
            'phone' => '0600000001',
            'address' => 'Adresse enseignant',
        ]);

        $studentUser = User::create([
            'name' => 'Etudiant Demo',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        Student::create([
            'user_id' => $studentUser->id,
            'class_id' => $classA->id,
            'phone' => '0600000002',
            'address' => 'Adresse etudiant',
        ]);

        Book::insert([
            ['title' => 'Laravel Basics', 'author' => 'School Library', 'category' => 'Informatique', 'description' => 'Introduction a Laravel.', 'available' => true, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Mathematiques 1', 'author' => 'Equipe Pedagogique', 'category' => 'Mathematiques', 'description' => 'Exercices et cours.', 'available' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        Assignment::create([
            'title' => 'Premier devoir',
            'description' => 'Lire le chapitre 1 et preparer les exercices.',
            'class_id' => $classA->id,
            'teacher_id' => $teacher->id,
            'due_date' => now()->addWeek()->toDateString(),
            'file_link' => 'https://example.com/devoir',
        ]);
    }
}
