<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = "task";

    protected $fillable = [
        'id',
        'task',
        'date',
        'pract_student_id',
        'pract_id',
    ];
}
