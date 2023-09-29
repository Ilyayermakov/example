<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 'time',
        'name', 'email', 'telephon', 'comment',
        'procedure', 'price',
        'profile_id',
        'active'
    ];

    protected $attributes = [
        'discount' => 0,
    ];

    protected $guarded = [
        'id',
    ];

}
