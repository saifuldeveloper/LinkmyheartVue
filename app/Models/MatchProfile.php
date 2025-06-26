<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchProfile extends Model
{
    //

        protected $fillable = [
        'user_id',
        'looking_for',
        'from_age',
        'to_age',
        'marital_status',
        'religion',
        'location',
        'education',
        'height_from',
        'height_to',
        // add any other fillable fields here
    ];
}
