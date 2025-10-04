<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserQuestStatistic;
use App\Models\GroupStatistic;
use App\Models\Group;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Получаем статистику пользователя по всем группам
        $userStatistics = UserQuestStatistic::with('group')
            ->where('user_id', $user->id)
            ->orderBy('last_activity', 'desc')
            ->get();
            
        // Получаем общую статистику по группам пользователя
        $groupIds = $userStatistics->pluck('group_id');
        $groupStatistics = GroupStatistic::whereIn('group_id', $groupIds)->get();
        
        // Считаем общую статистику
        $totalStats = [
            'total_quests' => $userStatistics->sum('total_quests'),
            'completed_quests' => $userStatistics->sum('completed_quests'),
            'success_rate' => $userStatistics->avg('success_rate'),
            'active_groups' => $userStatistics->count()
        ];
        
        return view('welcome', compact('userStatistics', 'groupStatistics', 'totalStats'));
    }
}