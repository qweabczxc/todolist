<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="{{ asset('css/reg-log.css') }}" rel="stylesheet">
    <title>q</title>
</head>

<body>
<ul>
        @foreach ($errors->all() as $m)
            <li>{{ $m }}</li>
        @endforeach
    </ul>
    <div class="container" id="container">
        <div class="form-container sign-up">
        <form action="{{ route('register') }}" method="POST">
                @csrf
                <h1 class="create_account">Создание аккаунта</h1>
                <input type="text" placeholder="Имя" name="name">
                <input type="email" placeholder="Почта" name="email">
                <input type="password" placeholder="Пароль" name="password">
                <button>Зарегистрироваться</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <h1>Вход в аккаунт</h1>
                <input type="email" placeholder="Почта" name="email">
                <input type="password" placeholder="Пароль" name="password">
                <button>Авторизироваться</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                
                    <p>Зарегистрируйтесь, указав свои личные данные, чтобы использовать все функции сайта</p>
                    <button class="hidden" id="login">Уже есть аккаунт?</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>С возвращением!</h1>
                    <p>Введите свои личные данные, чтобы использовать все функции сайта</p>
                    <button class="hidden" id="register">Ещё нет аккаунта?</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    
const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

</script>