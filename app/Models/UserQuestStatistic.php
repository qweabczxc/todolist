<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuestStatistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'group_id',
        'total_quests',
        'completed_quests',
        'in_progress_quests',
        'failed_quests',
        'daily_quests',
        'goal_quests',
        'success_rate',
        'last_activity'
    ];

    protected $casts = [
        'last_activity' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}