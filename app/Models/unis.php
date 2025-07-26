<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class unis extends Model
{
    protected $fillable=[
        "unit","master_id","lesson_id","student_id","number_term"
    ];
}
