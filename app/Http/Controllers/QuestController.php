<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestRequest;
use App\Models\Quest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestController extends Controller
{
    public function index(){
        $quests = Quest::all();
        return view('quests.index',[
            'quests' => $quests
        ]);
    }
    public function create(){
        return view('quests.create');
    }
    public function store(QuestRequest $request){
        // $request->validated();

        Quest::create([
            'name' => $request->name,
            'text' => $request->text,
            'solved' => 0,
            'users_id' => Auth::id(),

        ]);
        $request->session()->flash('alert-success','Quest created');
        return to_route('quest.index');
    }

    public function show($id){
        $quest = Quest::find($id);
        if(!$quest || Auth::id() != $quest->users_id){
            request()->session()->flash('error','Unable to locate the todo');
            return to_route('quest.index')->withErrors([
                'error' => 'Unable to locate the todo'
            ]);
        }
        return view('quests.show', ['quest' => $quest]);
    }

    public function edit($id){
        $quest = Quest::find($id);
        if(!$quest || Auth::id() != $quest->users_id){
            request()->session()->flash('error','Unable to locate the todo');
            return to_route('quest.index')->withErrors([
                'error' => 'Unable to locate the todo'
            ]);
        }
        return view('quests.edit', ['quest' => $quest]);
    }

    public function update(QuestRequest $request){
        $quest = Quest::find($request->quest_id);
        if(!$quest || Auth::id() != $quest->users_id){
            request()->session()->flash('error','Unable to locate the todo');
            return to_route('quest.index')->withErrors([
                'error' => 'Unable to locate the todo'
            ]);
        }

        $quest->update([
            'name' => $request->name,
            'text' => $request->text,
            'solved' => $request->solved

        ]);
        request()->session()->flash('alert-info','Updated successfully');
        return to_route('quest.index');
    }


    public function destroy(QuestRequest $request){
        $quest = Quest::find($request->quest_id);
        if(!$quest || Auth::id() != $quest->users_id){
            request()->session()->flash('error','Unable to locate the todo');
            return to_route('quest.index')->withErrors([
                'error' => 'Unable to locate the todo'
            ]);
        }
        $quest->delete();
        request()->session()->flash('alert-success','Deleted successfully');
        return to_route('quest.index');
    }
}
