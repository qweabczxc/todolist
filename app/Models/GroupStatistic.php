<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupStatistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'total_members',
        'active_members',
        'total_quests',
        'completed_quests',
        'quests_this_week',
        'average_completion_time',
        'group_success_rate'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}