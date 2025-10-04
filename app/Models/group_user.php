<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group_user extends Model
{
    use HasFactory;
        protected $fillable = [
        'name',
        'text',
        'solved',
        'users_id'
    ];
}
