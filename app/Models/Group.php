<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Quest;

class Group extends Model
{
    use HasFactory;
protected $fillable = ['id', 'name', 'password'];
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function quests()
    {
        return $this->hasMany(Quest::class);
    }
}
