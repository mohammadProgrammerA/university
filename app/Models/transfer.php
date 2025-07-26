<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transfer extends Model
{
    protected $fillable=[
        "nowUni","nextUni","student_id","status","college","field","number_term"
    ];
}
