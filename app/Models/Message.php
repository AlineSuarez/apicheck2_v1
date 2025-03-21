<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'content',
        'user_id',
        'role'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
