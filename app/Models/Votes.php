<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    //
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'message_id',
        'type', // 'up' or 'down'
    ];

    public function user(){
        $this->belongsTo(User::class);
    }

    public function messsage(){
        $this->belongsTo(Message::class);
    }
}
