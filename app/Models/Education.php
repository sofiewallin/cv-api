<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'degree',
        'institution',
        'institution_website',
        'start_date',
        'end_date',
        'type',
        'order'
    ];
}
