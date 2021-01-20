<?php

namespace App\Models\Ajax;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{

//    use HasFactory;

    protected $fillable = [
        'title', 'start', 'end'
    ];
}
