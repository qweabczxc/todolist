<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\GroupStatistic;
use App\Models\UserQuestStatistic;
use Carbon\Carbon; 
class createGroup extends Controller
{
    public function create(){
        return view('groups.createGroup');
    }
    public function storeReg(Request $request)
{
    $request->validate([
        'name' => ['required', 'string'],
        'password' => ['required']
    ]);
    
    $group = Group::create([
        'name' => $request->name,
        'password' => Hash::make($request->password)
    ]);
    
    $group->users()->attach(auth()->id());
    
    // Создаем начальную статистику для группы
    GroupStatistic::create([
        'group_id' => $group->id,
        'total_members' => 1,
        'active_members' => 1,
        'total_quests' => 0,
        'completed_quests' => 0,
        'quests_this_week' => 0,
        'average_completion_time' => 0,
        'group_success_rate' => 0
    ]);
    
    // Создаем статистику для пользователя в этой группе
    UserQuestStatistic::create([
        'user_id' => auth()->id(),
        'group_id' => $group->id,
        'total_quests' => 0,
        'completed_quests' => 0,
        'in_progress_quests' => 0,
        'failed_quests' => 0,
        'daily_quests' => 0,
        'goal_quests' => 0,
        'success_rate' => 0,
        'last_activity' => Carbon::now()
    ]);

    return redirect()->route('groups');
}
    public function storeLog(Request $request){
        $request->validate([
            'id' => ['required'],
            'password' => ['required']
        ]);
            $group = Group::find($request->id);

    if (!$group) {
        return back()->withErrors(['id' => 'Группа с таким ID не найдена']);
    }

    // Проверяем совпадает ли пароль (расшифровываем хэш)
    if (!Hash::check($request->password, $group->password)) {
        return back()->withErrors(['password' => 'Неверный пароль']);
    }
    // Проверяем есть ли уже пользователь в группе
if (!$group->users()->where('user_id', auth()->id())->exists()) {
    $group->users()->attach(auth()->id());
}

        return redirect()->route('groups');
    }
}
