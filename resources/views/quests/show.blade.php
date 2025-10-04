<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задание: {{ $quest->name }}</title>
<link href="{{ asset('css/show.css') }}" rel="stylesheet">
</head>
<body>
    <div class="quest-container">
        <div class="quest-header">
            <h1 class="quest-title">{{ $quest->name }}</h1>
            <span class="badge {{ $quest->goal_or_daily ? 'badge-goal' : 'badge-daily' }}">
                {{ $quest->goal_or_daily ? 'Цель' : 'Ежедневное' }}
            </span>
        </div>
        
        <div class="quest-meta">
            <div>
                <span class="info-label">Статус:</span>
                <span class="{{ $quest->solved ? 'status-solved' : 'status-unsolved' }}">
                    {{ $quest->solved ? 'Решено' : 'Не решено' }}
                </span>
            </div>
            <div>
                <span class="info-label">Создано:</span>
                <span>{{ $quest->created_at->format('d.m.Y H:i') }}</span>
            </div>
        </div>
        
        <div class="quest-info">
            <div class="info-card">
                <div class="info-label">ID задания</div>
                <div class="info-value">#{{ $quest->id }}</div>
            </div>
            
            <div class="info-card">
                <div class="info-label">ID группы</div>
                <div class="info-value">#{{ $quest->group_id }}</div>
            </div>
            
            
            <div class="info-card">
                <div class="info-label">Статус решения</div>
                <div class="info-value {{ $quest->solved ? 'status-solved' : 'status-unsolved' }}">
                    {{ $quest->solved ? 'Решено' : 'Не решено' }}
                </div>
            </div>
        </div>
        
        <div class="quest-content">
            <h3>Описание задания</h3>
            <p>{{ $quest->text }}</p>
        </div>
        
        @if($quest->user)
        <div class="creator-info">
            <div class="creator-avatar">
                {{ substr($quest->user->name, 0, 1) }}
            </div>
            <div>
                <div class="info-label">Создатель задания</div>
                <div class="info-value">{{ $quest->user->name }}</div>
                <div style="font-size: 0.9rem; color: #6c757d;">{{ $quest->user->email }}</div>
            </div>
        </div>
        @endif
    </div>
</body>
</html>