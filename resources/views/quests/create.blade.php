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
            <p class="left_p">Создание задания</p>
        </div>
        <form method="post" action="{{ route('quest.store') }}">
            @csrf
            <div class="qwerwe"> <label>Название</label>
                <input type="text" name="name" >
            </div>
            <div class="qwerwe">
                <label>Описание</label>
                <textarea name="text"></textarea>
            </div>
            <button>Отправить</button>
        </form>
    </main>
</body>

</html>