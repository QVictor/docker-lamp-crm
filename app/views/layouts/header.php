<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/template/css/main.css">
</head>
<body>
<header id="header">
    <a href="/basket/">Корзина</a>
    <? if(isset($_SESSION['basket'])): ?>
    <div id="countProductInBasket"></div>
    <?endif;?>
    <? if (User::isGuest()): ?>
        <a href="/user/login/">Войти</a>
    <? else: ?>
        <a href="/cabinet/">Личный кабинет</a>
        <a href="/user/logout/">Выйти</a>
    <? endif ?>
</header>