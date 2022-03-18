<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'workplace',
        'workplace_website',
        'start_date',
        'end_date',
        'order'
    ];
}
