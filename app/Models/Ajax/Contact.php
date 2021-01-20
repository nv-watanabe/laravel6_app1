<?php

namespace App\Models\Ajax;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false;

    protected $table = 'contacts';

    protected $guarded = ['id'];
}
