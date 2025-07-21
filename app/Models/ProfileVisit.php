<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileVisit extends Model
{
    protected $fillable = [
        'visitor_id',
        'visited_id',
    ];

    
}
