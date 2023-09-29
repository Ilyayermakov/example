<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title', 'content',
        'published', 'published_at',
        'file',
        'tags',
    ];

    public function tagsToArray()
    {
        return json_decode($this->tags, true);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected $casts = [
        'user_id' => 'integer',
        'published' => 'boolean',
        'published_at' => 'datetime',
    ];
}
