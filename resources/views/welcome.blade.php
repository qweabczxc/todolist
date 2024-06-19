<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    @guest
    <?php
    Header('Location: register');
    exit;
    ?>
    @endguest
    @auth
    <?php
    Header('Location: /index');
    exit;
    ?>
    @endauth
</body>

</html>