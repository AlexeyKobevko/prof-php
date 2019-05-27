<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TITLE</title>
    <link rel="stylesheet" href="/styles/main.css">
</head>
<body>
<header>
    <div class="header">
        <div class="logo">
            <a href="/"><img src="/img/placeholder.com-logo2.png" alt=""></a>
        </div>
        <ul class="main-menu">
            <li class="main-menu-item">
                <a class="main-menu-item-link" href="/">Главная</a>
            </li><li class="main-menu-item">
                <a class="main-menu-item-link" href="/?c=product&a=catalog">Каталог</a>
            </li>
            <li class="main-menu-item">
                <a class="main-menu-item-link" href="/?c=user">Пользователи</a>
            </li>
            <li class="main-menu-item"><a class="main-menu-item-link" href="/?c=basket">Корзина</a></li>
        </ul>
    </div>
</header>
<div class="container">
<?=$content?>
</div>
</body>
</html>