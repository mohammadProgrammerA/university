<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class master_vaset extends Model
{
    protected $fillable=[
        "master_id","uni_id","college_id","field_id","lesson_id"
    ];
}
