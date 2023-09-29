<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spent extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id', 'date', 'name', 'quantity', 'price',

    ];
    protected $guarded = [
        'id',
    ];
}
