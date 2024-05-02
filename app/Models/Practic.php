<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practic extends Model
{
    use HasFactory;

    protected $table = "pract";

    protected $fillable = [
        'id',
        'name',
        'type_id',
        'view_id',
        'group_id',
        'place_id',
        'agreement_id',
        'year',
        'date_begin',
        'money',
        'date_end',
        'order_id',
        'director_id',
        'director_ugu_id',
        'director_pr_id',
        'director_or_id'
    ];
}
