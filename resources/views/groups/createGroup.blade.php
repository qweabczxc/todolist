<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Групповой менеджер задач</title>
    <style>
        :root {
            --primary-color: #6c63ff;
            --secondary-color: #4a44c9;
            --accent-color: #ff6584;
            --light-color: #f5f5f5;
            --dark-color: #2a2a2a;
            --success-color: #4caf50;
            --error-color: #f44336;
            --shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: white;
            border-radius: 20px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 850px;
            min-height: 550px;
            overflow: hidden;
            position: relative;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: var(--transition);
            width: 50%;
        }

        .sign-up {
            left: 0;
            width: 50%;
            z-index: 1;
            opacity: 0;
        }

        .sign-in {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        form {
            background-color: white;
            display: flex;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        h1 {
            color: var(--dark-color);
            margin-bottom: 24px;
            font-weight: 600;
        }

        .create_account {
            color: var(--primary-color);
        }

        input {
            background-color: #f0f0f0;
            border: none;
            padding: 16px 20px;
            margin: 10px 0;
            width: 100%;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            transition: var(--transition);
        }

        input:focus {
            background-color: #e8f0fe;
            box-shadow: 0 0 0 2px var(--primary-color);
        }

        button {
            border-radius: 10px;
            border: 1px solid var(--primary-color);
            background-color: var(--primary-color);
            color: white;
            font-size: 14px;
            font-weight: 600;
            padding: 14px 45px;
            margin-top: 20px;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: var(--transition);
        }

        button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .toggle-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: var(--transition);
            z-index: 100;
            border-radius: 0 20px 20px 0;
        }

        .toggle {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            height: 100%;
            background-size: cover;
            background-position: 0 0;
            color: white;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: var(--transition);
        }

        .toggle-panel {
            position: absolute;
            width: 50%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0 40px;
            text-align: center;
            top: 0;
            transform: translateX(0);
            transition: var(--transition);
        }

        .toggle-left {
            transform: translateX(-200%);
        }

        .toggle-right {
            right: 0;
            transform: translateX(0);
        }

        .toggle-panel h1 {
            color: white;
            font-weight: 600;
            margin-bottom: 24px;
        }

        .toggle-panel p {
            margin-bottom: 30px;
            font-size: 16px;
            line-height: 1.6;
        }

        .toggle-panel button {
            background-color: transparent;
            border: 2px solid white;
            color: white;
        }

        .toggle-panel button:hover {
            background-color: white;
            color: var(--primary-color);
        }

        .container.active .sign-up {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
        }

        .container.active .sign-in {
            transform: translateX(100%);
        }

        .container.active .toggle-container {
            transform: translateX(-100%);
            border-radius: 20px 0 0 20px;
        }

        .container.active .toggle {
            transform: translateX(50%);
        }

        .container.active .toggle-left {
            transform: translateX(0);
        }

        .container.active .toggle-right {
            transform: translateX(200%);
        }

        .error-container {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            background-color: var(--error-color);
            color: white;
            padding: 15px;
            border-radius: 10px;
            z-index: 1000;
            box-shadow: var(--shadow);
            display: none;
        }

        .error-container ul {
            list-style: none;
            text-align: center;
        }

        .error-container li {
            margin: 5px 0;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            align-items: center;
            z-index: 10;
        }

        .logo i {
            font-size: 24px;
            color: var(--primary-color);
            margin-right: 10px;
        }

        .logo span {
            font-weight: 700;
            font-size: 20px;
            color: var(--dark-color);
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                height: auto;
                max-width: 400px;
            }

            .form-container {
                position: relative;
                width: 100%;
                height: auto;
            }

            .toggle-container {
                display: none;
            }

            .sign-up, .sign-in {
                width: 100%;
                position: relative;
            }

            form {
                padding: 40px 30px;
            }

            .container.active .sign-up,
            .container.active .sign-in {
                transform: none;
            }
        }
    </style>
</head>

<body>
    <div class="container" id="container">
        <div class="logo">
            <i class="fas fa-tasks"></i>
            <span>zxWat?</span>
        </div>

        <div class="error-container" id="errorContainer">
            <ul>
                @foreach ($errors->all() as $m)
                    <li>{{ $m }}</li>
                @endforeach
            </ul>
        </div>

        <div class="form-container sign-up">
            <form action="{{ route('storeReg') }}" method="POST">
                @csrf
                <h1 class="create_account">Создание группы</h1>
                <input type="text" placeholder="Название группы" name="name">
                <input type="password" placeholder="Пароль" name="password">
                <button>Создать группу</button>
            </form>
        </div>
        
        <div class="form-container sign-in">
            <form action="{{ route('storeLog') }}" method="post">
                @csrf
                <h1>Вход в группу</h1>
                <input type="text" placeholder="Название группы" name="id">
                <input type="password" placeholder="Пароль" name="password">
                <button>Войти в группу</button>
            </form>
        </div>
        
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Уже есть группа?</h1>
                    <p>Войдите в свою группу, чтобы управлять заданиями</p>
                    <button class="hidden" id="login">Войти в группу</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Новая группа?</h1>
                    <p>Создайте новую группу для управления заданиями</p>
                    <button class="hidden" id="register">Создать группу</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');
        const errorContainer = document.getElementById('errorContainer');
        
        // Показать ошибки, если они есть
        const errors = {!! json_encode($errors->all()) !!};
        if (errors.length > 0) {
            errorContainer.style.display = 'block';
            // Автоматически переключиться на соответствующую форму
            setTimeout(() => {
                if (window.location.href.indexOf('storeReg') > -1) {
                    container.classList.add("active");
                }
            }, 300);
            
            // Скрыть ошибки через 5 секунд
            setTimeout(() => {
                errorContainer.style.display = 'none';
            }, 5000);
        }
        
        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });
        
        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });
    </script>
</body>

</html>