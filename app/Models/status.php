<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class status extends Model
{
   protected $fillable=[
        "transfer_details","leave","status","number_term","middle_student_id"
   ];
}
