<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/edit.css') }}" rel="stylesheet">
</head>
<a href="{{ route('quest.index') }}" class="back">Назад</a>
<body>
    
    <ul>
        @foreach ($errors->all() as $m)
        <li>{{ $m }}</li>
        @endforeach
    </ul>
    <main>
    

        <div class="left_div">
            <p class="left_p">Внесите изменение в задание</p>
        </div>
        <form method="post" action="{{ route('quest.update') }}">

            @csrf
            @method('PUT')

            <input type="hidden" name="quest_id" value="{{ $quest->id }}">
            <div class="qwerwe"> <label>Название</label>
                <input type="text" name="name" value="{{ $quest->name }}">
            </div>
            <div class="qwerwe">
                <label>Описание</label>
                <textarea name="text">{{ $quest->text }}</textarea>
            </div>
            <div class="qwerwe">
                <label for=""> Статус</label>
                <select name="solved" id="">
                    <option value="1" @selected($quest->solved)>Выполнено</option>
                    <option value="0" @selected(!$quest->solved)>Не выполнено</option>
                </select>
            </div>
            <button>Отправить</button>
        </form>
    </main>
</body>

</html>