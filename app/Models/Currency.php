<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    public $incrementig = false;

    protected $fillable = [
       'id', 'name', 'price',
        'active', 'sort',
    ];

    // protected $dates = [
    //     'active_at'
    // ];

    // protected $casts = [
    //     'price' => 'float'
    // ];
}
