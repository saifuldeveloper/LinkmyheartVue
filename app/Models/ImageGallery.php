<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageGallery extends Model
{
     protected $fillable = [
        'user_id',   // ID of the user uploading the image
        'image', // Name or path of the uploaded image
    ];
}
