<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'status'];

    protected $visible = ['id', 'title', 'status'];
}
