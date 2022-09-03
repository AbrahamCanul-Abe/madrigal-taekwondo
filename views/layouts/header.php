<?php

use yii\helpers\Url;

?>
    <header class="header">


    <a href="#" class="logo">
        <img src="../img/logo.png" alt="">
    </a>

    <nav class="navbar">
        <a href=<?= Url::to(['site/index']);?>>Inicio</a>
        <a href=<?= Url::to(['site/categorias']);?>>Categorias</a>
        <a href=<?= Url::to(['site/mapa']);?>>Mi alrededor</a>
    </nav>

    <div class="icons">
        <div class="fas fa-search" id="search-btn"></div>
        <div class="fas fa-bars" id="menu-btn"></div>
    </div>

    <div class="search-form">
        <input type="search" id="search-box" placeholder="Buscar">
        <label for="search-box" class="fas fa-search"></label>
    </div>

    </header>