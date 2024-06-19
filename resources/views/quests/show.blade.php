<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
</head>

<body>
    <a href="{{ url()->previous() }}">Go back</a>
    <main>
        <table>
            <tr><th><p>Название: </p></th>
           <td>{{ $quest->name}}</td> </tr>
            <br>
            <tr><th><p>Описание: </p></th>
            <td>{{ $quest->text}}</td></tr>
            <br>
            <tr><th><p>Статус </p></th>
            @if ($quest->solved)
            <td><p>Выполнено</p></td>
            @else
            <td><p>Не выполнено</p></td>
            @endif</tr>

            <tr><th><p>Дата создания: </p></th>
            <td>{{ $quest->created_at}}</td></tr>
        </table>
    </main>
</body>

</html>