<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConnectionRequest extends Model
{

    protected $fillable = [
        'sender_id',   // ID of the user sending the request
        'recipient_id', // ID of the user receiving the request
        'status',    
    ];
    public function recipient()
    {
        return $this->belongsTo(Profile::class, 'recipient_id');
    }

    public function sender()
    {
        return $this->belongsTo(Profile::class, 'sender_id');
    }
}
