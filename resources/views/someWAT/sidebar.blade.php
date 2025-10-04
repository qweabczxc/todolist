<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<aside class="sidebar">
  <nav>
    <ul>
      <li><a href="{{ route('dashboard') }}">Главная</a></li>
      <li><a href="{{ route('groups') }}">Группа</a></li>
    </ul>
  </nav>
</aside>
</body>
</html>
<style>
	.sidebar {
  width: 200px;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  background-color: #2c3e50;
  color: white;
  padding: 15px;
  box-shadow: 2px 0 5px rgba(0,0,0,0.5);
}

.sidebar nav ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.sidebar nav ul li {
  margin: 10px 0;
   /* плавное разделение */
}

.sidebar nav ul li a {
  color: white;
  text-decoration: none;
  display: block;
  padding: 8px 5px;
  border-radius: 4px;
  transition: background-color 0.3s ease, color 0.3s ease;
}

.sidebar nav ul li a:hover {
  background-color: #66cdaa; /* мятный цвет при наведении */
  color: #333; /* тёмный текст, чтобы выделить */
}

.sidebar nav ul li a.active {
  background-color: #00bfff; /* ярко-голубой цвет для активного пункта */
  color: white;
  font-weight: bold;
}
</style>