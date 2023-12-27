<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['text', 'completed'];

    protected $hidden = ['created_at', 'updated_at'];
}
