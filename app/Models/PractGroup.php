<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PractGroup extends Model
{
    use HasFactory;

    protected $table = "pract_group";

    protected $fillable = [
        'pract_id',
        'group_id',
    ];
}
