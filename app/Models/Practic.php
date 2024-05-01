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
        'year',
        'date_begin',
        'date_end',
        'order_id',
        'director_id',
        'director_ugu_id',
    ];
}
