<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    //
    use HasFactory, HasUlids;
    protected $table = 'boxes';
    protected $fillable = [
        'box_name',
        'box_description',
        'users_id',
        'status',
        'privacy',
    ];


    public function user(){
        return $this->belongsTo(User::class, 'users_id');
    }
}
