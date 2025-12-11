<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //

    protected $fillable = [
        'user_id',
        'box_id',
        'content',
        'upvotes',
        'downvotes',
    ];

    public function getReadableDateAttribute()
    {
        if ($this->created_at->diffInHours() < 24) {
            return $this->created_at->diffForHumans();
        }

        return $this->created_at->format('M d, Y');
    }

    public function votes()
    {
        return $this->hasMany(Votes::class);
    }

    public function userVotes()
    {
        return $this->hasOne(Votes::class)->where('user_id', auth()->id());
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function box()
    {
        return $this->belongsTo(box::class, 'box_id');
    }
}
