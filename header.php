<?php
  header('Content-Type: text/html; charset=UTF-8');
  ?>

<html>
<!--Head e header da página, contendo os "links" pré-estabelecidos de estilos, scripts [...] e o menu principal -->

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;1,700&display=swap" rel="stylesheet">

    
  </head>

    <header>
      <nav>
        <a class="logo" href="/">RockXaba</a> 
        <div class="mobile-menu">
          <div class="line1"></div>
          <div class="line2"></div>
          <div class="line3"></div>
        </div>
        <ul class="nav-list">
          <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">Sobre</a></li>
                        <li><a href="artistas.php">Artistas</a></li>
                        <li><a href="follow.php">Siga-nos</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="contato.php">Contato</a></li>
        </ul>
      </nav>
    </header>


<body>
<script type="text/javascript" src="js/mobile-navbar.js"></script>
