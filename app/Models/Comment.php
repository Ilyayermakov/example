<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'post_id',
        'content',
        'file',
    ];

    public function user()
     {
         return $this->belongsTo(User::class);
     }
}
