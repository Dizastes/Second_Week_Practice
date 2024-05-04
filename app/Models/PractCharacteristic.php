<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PractCharacteristic extends Model
{
    use HasFactory;

    protected $table = "pract_characteristic";

    protected $fillable = [
        'id',
        'pract_id',
        'characteristic_id',
    ];
}
