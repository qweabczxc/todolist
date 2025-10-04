<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class groups extends Controller
{
    public function create()
{
    $user = auth()->user();
    $groups = $user->groups; // Получаем группы пользователя
    return view('groups.group', compact('groups'));
}

}
