<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoxMember extends Model
{
    // 1. Explicitly define the table name to avoid confusion
    protected $table = 'box_members';

    // 2. Allow these columns to be filled by your joinBox() function
    protected $fillable = [
        '   ',
        'user_id',
        'status', 
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function box()
    {
        return $this->belongsTo(Box::class);
    }
}
