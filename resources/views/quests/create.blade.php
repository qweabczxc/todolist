<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/edit.css') }}" rel="stylesheet">
</head>

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
            <label>Название</label>
            <input type="text" name="name">
            <label>Описание</label>
            <textarea name="text"></textarea>
            <button>Отправить</button>
        </form>
    </main>
</body>

</html>