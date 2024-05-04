<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PractStudent extends Model
{
    use HasFactory;

    protected $table = "pract_student";

    protected $fillable = [
        'id',
        'pract_id',
        'student_id',
        'volume_id',
        'mark',
        'reason_id',
        'complete',
        'status',
        'tasks',
    ];
}
