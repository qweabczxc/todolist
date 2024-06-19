<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
</head>
<body>
    <ul>
        @foreach ($errors->all() as $m)
        <li>{{ $m }}</li>
        @endforeach
    </ul>
    @if(Session::has('alert-success'))
    <p class="session-message">{{ Session::get('alert-success') }}</p>
    @endif
    @if(Session::has('alert-info'))
    <p class="session-message">{{ Session::get('alert-info') }}</p>
    @endif
    @if(Session::has('error'))
    <p class="session-message">{{ Session::get('error') }}</p>

    @endif
    <form action="{{ route('logout') }}" method="post">
    @csrf
    <button class="quit">Выход</button>
</form>
    <main>
        <p class="TopText">название</p>

        @if(count($quests) > 0)
        @foreach($quests as $quest)
        @if($quest->users_id == Auth::id())

        <div class="table">
            <div class="test">
                <p class="name">{{Str::limit($quest->name ,15  ) }}</p>
                @if ($quest->solved)
                <p class="true">Выполнено</p>
                @else
                <p class="false">Не выполнено</p>
                @endif
            </div>


            <div class="buttons">
                <div class="wrapper">
                    <a href="{{ route('quest.edit', $quest->id) }}" class="edit abuttons"><span>Изменить</span></a>
                    <a href="{{ route('quest.show', $quest->id) }}" class="view abuttons"><span>Просмотр</span></a>
                </div>
                <form method="post" action="{{ route('quest.destroy') }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="quest_id" value="{{ $quest->id }}">
                    <button class="delete abuttons"><span>Удалить</span></button>
                </form>
            </div>

        </div>
        @endif
        @endforeach


        @endif
        <div class="double_main">
            <a href="{{ route('quest.create') }}" class="create"><span>Создать</span></a>
        </div>
    </main>
</body>

</html>