<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PractRemark extends Model
{
    use HasFactory;

    protected $table = "pract_remark";

    protected $fillable = [
        'id',
        'pract_id',
        'remark_id',
    ];
}
