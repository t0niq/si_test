<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    public function tasks()
    {
       return $this->hasMany(Task::class);
    }
}
