<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'category', 'description', 'available'];

    protected function casts(): array
    {
        return ['available' => 'boolean'];
    }
}
