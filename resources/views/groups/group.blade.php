<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="{{ asset('css/group.css') }}" rel="stylesheet">
</head>
<body>
@include('someWAT.sidebar')
<div id="firstLine">
  <h1>Мои группы</h1>
<a href="{{route('createGroup')}}">+</a>
</div>
<div id="secondLine">
<input type="text">
</div>
<ul class="groups-list">
    @foreach($groups as $group)
    
        <li onclick="window.location='{{ route('quest.index', ['group' => $group->id]) }}'" style="cursor: pointer;">
                        <a>
                {{ $group->name }}
                
            </a>
            <span class="group-id">{{ $group->id }}</span>
        </li>
    @endforeach
</ul>





</body>
</html>