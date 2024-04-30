<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class direction extends Model
{
    use HasFactory;

    protected $table = "direction";

    protected $fillable = [
        'name',
        'code',
        'institute_id'
    ];
}
