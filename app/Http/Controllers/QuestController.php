<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestRequest;
use App\Models\Quest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\UserQuestStatistic;
use App\Models\GroupStatistic;
use Carbon\Carbon; 
class QuestController extends Controller
{
public function index($group)
{
    // Теперь в $group будет 3, если URL /quests/group/3

    $quests = Quest::where('group_id', $group)->get();

    // дальнейшая логика
    return view('quests.index', compact('quests', 'group'));
}



public function create(Request $request)
{
    $group = $request->query('group');
    return view('quests.create', compact('group'));
}





public function show($id, Request $request)
{
    $groupId = $request->input('group') ?? $request->query('group');
    $quest = Quest::with('group')->find($id); // Загружаем задание с группой

    // Проверяем, что задание существует и что группа у задания совпадает с нужной (например, текущей или переданной)
    // Например, если нужно проверить, что группа есть и это та, что есть у пользователя
    if (!$quest) {
        request()->session()->flash('error', 'Не удается найти задачу');
        return to_route('quest.index', ['group' => $groupId]);
    }

    // Если хотите ограничить по группе, например, по текущей группе пользователя, можно сравнить:
    // if ($quest->group_id != $someGroupId) { ... }

    // Сейчас условие убрано, чтобы показать все задания с группой

    return view('quests.show', ['quest' => $quest]);
}


    public function edit($id, Request $request)
    {
        $groupId = $request->input('group') ?? $request->query('group');
        $quest = Quest::with('group')->find($id); 
   if (!$quest) {
        request()->session()->flash('error', 'Не удается найти задачу');
        return to_route('quest.index', ['group' => $groupId]);
    }
        return view('quests.edit', ['quest' => $quest]);
    }

public function store(QuestRequest $request)
{
    // Получаем group из запроса, можно из query или input
    $groupId = $request->input('group') ?? $request->query('group');

    $quest = Quest::create([
        'name' => $request->name,
        'text' => $request->text,
        'solved' => 0,
        'users_id' => Auth::id(),
        'group_id' => $groupId,
    ]);

    // Обновляем статистику пользователя в группе
    $this->updateUserQuestStatistics(Auth::id(), $groupId);
    
    // Обновляем статистику группы
    $this->updateGroupStatistics($groupId);

    $request->session()->flash('alert-success', 'Задание создано');
    return to_route('quest.index', ['group' => $groupId]);
}

public function update(QuestRequest $request, $id)
{
    $quest = Quest::find($id);
    $groupId = $quest->group_id;
    
    if (!$quest) {
        request()->session()->flash('error', 'Не удается найти задачу');
        return to_route('quest.index', ['group' => $groupId]);
    }
    
    $user = Auth::user();
    if (!$user->groups->contains('id', $quest->group_id)) {
        request()->session()->flash('error', 'У вас нет прав на редактирование этой задачи');
        return to_route('quest.index', ['group' => $groupId]);
    }
    
    $oldSolvedStatus = $quest->solved;
    $quest->update([
        'name' => $request->name,
        'text' => $request->text,
        'solved' => $request->solved,
    ]);
    
    // Если изменился статус выполнения, обновляем статистику
    if ($oldSolvedStatus != $request->solved) {
        $this->updateUserQuestStatistics($quest->users_id, $groupId);
        $this->updateGroupStatistics($groupId);
    }
    
    request()->session()->flash('alert-info', 'Успешно обновлено');
    return to_route('quest.index', ['group' => $groupId]);
}

// Метод для обновления статистики пользователя в группе
private function updateUserQuestStatistics($userId, $groupId)
{
    // Получаем все задания пользователя в этой группе
    $userQuests = Quest::where('users_id', $userId)
        ->where('group_id', $groupId)
        ->get();
    
    $totalQuests = $userQuests->count();
    $completedQuests = $userQuests->where('solved', 2)->count();
    $inProgressQuests = $userQuests->where('solved', 1)->count();
    $failedQuests = 0; // Можно добавить логику для неудачных заданий если нужно
    
    $dailyQuests = $userQuests->where('goal_or_daily', 0)->count();
    $goalQuests = $userQuests->where('goal_or_daily', 1)->count();
    
    $successRate = $totalQuests > 0 ? ($completedQuests / $totalQuests) * 100 : 0;
    
    // Обновляем или создаем запись статистики
    UserQuestStatistic::updateOrCreate(
        [
            'user_id' => $userId,
            'group_id' => $groupId
        ],
        [
            'total_quests' => $totalQuests,
            'completed_quests' => $completedQuests,
            'in_progress_quests' => $inProgressQuests,
            'failed_quests' => $failedQuests,
            'daily_quests' => $dailyQuests,
            'goal_quests' => $goalQuests,
            'success_rate' => $successRate,
            'last_activity' => Carbon::now()
        ]
    );
}

// Метод для обновления статистики группы
private function updateGroupStatistics($groupId)
{
    // Получаем всех пользователей группы
    $groupUsers = Group::find($groupId)->users;
    $totalMembers = $groupUsers->count();
    
    // Получаем все задания в группе
    $groupQuests = Quest::where('group_id', $groupId)->get();
    $totalQuests = $groupQuests->count();
    $completedQuests = $groupQuests->where('solved', 2)->count();
    
    // Задания за последнюю неделю
    $questsThisWeek = Quest::where('group_id', $groupId)
        ->where('created_at', '>=', Carbon::now()->subWeek())
        ->count();
    
    // Активные пользователи (были активны в последние 7 дней)
    $activeMembers = UserQuestStatistic::where('group_id', $groupId)
        ->where('last_activity', '>=', Carbon::now()->subWeek())
        ->count();
    
    // Среднее время выполнения (упрощенная логика)
    $averageCompletionTime = 0; // Можно реализовать сложную логику если нужно
    
    $groupSuccessRate = $totalQuests > 0 ? ($completedQuests / $totalQuests) * 100 : 0;
    
    // Обновляем или создаем запись статистики группы
    GroupStatistic::updateOrCreate(
        ['group_id' => $groupId],
        [
            'total_members' => $totalMembers,
            'active_members' => $activeMembers,
            'total_quests' => $totalQuests,
            'completed_quests' => $completedQuests,
            'quests_this_week' => $questsThisWeek,
            'average_completion_time' => $averageCompletionTime,
            'group_success_rate' => $groupSuccessRate
        ]
    );
}
public function destroy(QuestRequest $request, $id)
{
    $quest = Quest::find($id);

    // Если задача не найдена — возвращаем с ошибкой
    if (!$quest) {
        // Если запись не найдена, groupId получить не получится, поэтому ставим null
        $groupId = $quest ? $quest->group_id : null;
        request()->session()->flash('error', 'Не удается найти задачу');
        return to_route('quest.index', ['group' => $groupId]);
    }

    $groupId = $quest->group_id; // теперь groupId получен из задачи
    $userId = $quest->users_id; // сохраняем ID пользователя для обновления статистики

    $user = Auth::user();

    // Проверяем, что у пользователя есть доступ к группе задачи
    if (!$user->groups->contains('id', $groupId)) {
        request()->session()->flash('error', 'У вас нет прав на удаление этой задачи');
        return to_route('quest.index', ['group' => $groupId]);
    }

    $quest->delete();

    // Обновляем статистику пользователя в группе после удаления задания
    $this->updateUserQuestStatistics($userId, $groupId);
    
    // Обновляем статистику группы после удаления задания
    $this->updateGroupStatistics($groupId);

    request()->session()->flash('alert-success', 'Успешно удалено');

    return to_route('quest.index', ['group' => $groupId]);
}

}
