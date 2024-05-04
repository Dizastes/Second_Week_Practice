<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PractProblem extends Model
{
    use HasFactory;

    protected $table = "pract_problem";

    protected $fillable = [
        'id',
        'pract_id',
        'problem_id',
    ];
}
