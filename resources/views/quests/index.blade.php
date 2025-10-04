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

@include('someWAT.sidebar')

    <main>
        <div class="wata">
            <p class="TopText">Надо выполнить</p>

        @if(count($quests) > 0)
        @foreach($quests as $quest)
        @if($quest->solved == 0)
   
        
    
        <div class="table" onclick="window.location='{{ route('quest.show', $quest->id) }}'" style="cursor: pointer;">
            
            <div class="test">


                <p class="name">{{Str::limit($quest->name ,15  ) }}</p>

            </div>


            <div class="buttons">
                <div class="wrapper">
                    <a href="{{ route('quest.edit', $quest->id) }}" class="edit abuttons"><span>Изменить</span></a>
                </div>
                <form method="post" action="{{ route('quest.destroy',  $quest->id) }}">
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
        </div>
                <div class="wata">
            <p class="TopText">Выполняется</p>

        @if(count($quests) > 0)
        @foreach($quests as $quest)
       @if($quest->solved == 1)
   
        
    
                <div class="table" onclick="window.location='{{ route('quest.show', $quest->id) }}'" style="cursor: pointer;">
            
            <div class="test">


                <p class="name">{{Str::limit($quest->name ,15  ) }}</p>

            </div>


            <div class="buttons">
                <div class="wrapper">
                    <a href="{{ route('quest.edit', $quest->id) }}" class="edit abuttons"><span>Изменить</span></a>
                </div>
                <form method="post" action="{{ route('quest.destroy',  $quest->id) }}">
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
                </div>
                <div class="wata">
            <p class="TopText">Выполнено</p>

        @if(count($quests) > 0)
        @foreach($quests as $quest)
        @if($quest->solved == 2)
   
        
    
                <div class="table" onclick="window.location='{{ route('quest.show', $quest->id) }}'" style="cursor: pointer;">
            
            <div class="test">


                <p class="name">{{Str::limit($quest->name ,15  ) }}</p>

            </div>


            <div class="buttons">
                <div class="wrapper">
                    <a href="{{ route('quest.edit', $quest->id) }}" class="edit abuttons"><span>Изменить</span></a>
                </div>
                <form method="post" action="{{ route('quest.destroy', $quest->id) }}">
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
        </div>
        <div class="double_main">
<a href="{{ route('quest.create') }}?group={{ $group }}" class="create"><span>Создать</span></a>




        </div>
    </main>
</body>

</html>