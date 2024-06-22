<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestRequest;
use App\Models\Quest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestController extends Controller
{
    public function index()
    {
        $quests = Quest::all();
        return view('quests.index', [
            'quests' => $quests
        ]);
    }
    public function create()
    {
        return view('quests.create');
    }
    public function store(QuestRequest $request)
    {
        // $request->validated();

        Quest::create([
            'name' => $request->name,
            'text' => $request->text,
            'solved' => 0,
            'users_id' => Auth::id(),

        ]);
        $request->session()->flash('alert-success', 'Задание создано');
        return to_route('quest.index');
    }

    public function show($id)
    {
        $quest = Quest::find($id);
        if (!$quest || Auth::id() != $quest->users_id) {
            request()->session()->flash('error', 'Не удается найти задачу');
            return to_route('quest.index');
        }
        return view('quests.show', ['quest' => $quest]);
    }

    public function edit($id)
    {
        $quest = Quest::find($id);
        if (!$quest || Auth::id() != $quest->users_id) {
            request()->session()->flash('error', 'Не удается найти задачу');
            return to_route('quest.index');
        }
        return view('quests.edit', ['quest' => $quest]);
    }

    public function update(QuestRequest $request)
    {
        $quest = Quest::find($request->quest_id);
        if (!$quest || Auth::id() != $quest->users_id) {
            request()->session()->flash('error', 'Не удается найти задачу');
            return to_route('quest.index');
        }

        $quest->update([
            'name' => $request->name,
            'text' => $request->text,
            'solved' => $request->solved

        ]);
        request()->session()->flash('alert-info', 'Успешно обновлено');
        return to_route('quest.index');
    }


    public function destroy(QuestRequest $request)
    {
        $quest = Quest::find($request->quest_id);
        if (!$quest || Auth::id() != $quest->users_id) {
            request()->session()->flash('error', 'Не удается найти задачу');
            return to_route('quest.index');
        }
        $quest->delete();
        request()->session()->flash('alert-success', 'Успешно удалено');
        return to_route('quest.index');
    }

}
