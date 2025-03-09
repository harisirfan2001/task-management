<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['description', 'assigned_to', 'deadline', 'remarks', 'date_of_creation', 'priority'];

}
