<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orderr";

    protected $fillable = [
        'pract_id',
        'number',
        'date'
    ];
}
