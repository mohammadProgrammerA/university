<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class term extends Model
{
    protected $fillable=[
        "status","average_term","passed_units","numbers_units","number_term","student_id"
    ];
}
