<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
</head>

<body>

    @guest
    <?php
    Header('Location: register');
    exit;
    ?>
    @endguest
    @auth
    @include('someWAT.sidebar')
<header>
        <div class="container">
            <nav>
                <div class="logo">
                    <i class="fas fa-tasks"></i>
                    <span>zxWat?</span>
                </div>
                <div class="user-menu">
                    <div class="user-info">
                        <div class="user-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span>{{ auth()->user()->name }}</span>
                    </div>
                    <a href="{{ route('logout') }}" class="btn">Выйти</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="dashboard">
        <div class="container">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <h1>Добро пожаловать, {{ auth()->user()->name }}!</h1>
                <p>Здесь вы можете увидеть свою статистику по заданиям во всех группах</p>
            </div>

            <!-- Overall Statistics -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon" style="color: var(--primary-color);">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="stat-value">{{ $totalStats['total_quests'] }}</div>
                    <div class="stat-label">Всего заданий</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="color: var(--success-color);">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-value">{{ $totalStats['completed_quests'] }}</div>
                    <div class="stat-label">Выполнено заданий</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="color: var(--warning-color);">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-value">{{ number_format($totalStats['success_rate'], 1) }}%</div>
                    <div class="stat-label">Процент успеха</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="color: var(--secondary-color);">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-value">{{ $totalStats['active_groups'] }}</div>
                    <div class="stat-label">Активных групп</div>
                </div>
            </div>

            <!-- Groups Statistics -->
            <div class="groups-section">
                <h2 class="section-title">Статистика по группам</h2>
                
                <div class="group-cards">
                    @foreach($userStatistics as $statistic)
                    @php
                        $successRateClass = 'rate-high';
                        if ($statistic->success_rate < 70) {
                            $successRateClass = 'rate-medium';
                        }
                        if ($statistic->success_rate < 40) {
                            $successRateClass = 'rate-low';
                        }
                    @endphp
                    
                    <div class="group-card">
                        <div class="group-header">
                            <h3 class="group-name">{{ $statistic->group->name }}</h3>
                            <span class="success-rate {{ $successRateClass }}">
                                {{ number_format($statistic->success_rate, 1) }}% успеха
                            </span>
                        </div>
                        
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $statistic->success_rate }}%; background-color: var(--primary-color);"></div>
                        </div>
                        
                        <div class="group-stats">
                            <div class="group-stat">
                                <div class="group-stat-value">{{ $statistic->total_quests }}</div>
                                <div class="group-stat-label">Всего заданий</div>
                            </div>
                            <div class="group-stat">
                                <div class="group-stat-value">{{ $statistic->completed_quests }}</div>
                                <div class="group-stat-label">Выполнено</div>
                            </div>
                            <div class="group-stat">
                                <div class="group-stat-value">{{ $statistic->in_progress_quests }}</div>
                                <div class="group-stat-label">В процессе</div>
                            </div>
                            <div class="group-stat">
                                <div class="group-stat-value">{{ $statistic->daily_quests }}</div>
                                <div class="group-stat-label">Ежедневные</div>
                            </div>
                        </div>
                        
                        <div class="last-activity">
                            Последняя активность: {{ $statistic->last_activity->diffForHumans() }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    
    @endauth
</body>

</html>