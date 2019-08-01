<?php
if(!isset($_SESSION['email']))
  header('location: index.php');

echo '<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mercado das Pulgas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <style>
    
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">MP</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link " href="inicio.php">Serviços </a>
      <a class="nav-item nav-link" href="compras.php">Compras</a>
      <a class="nav-item nav-link" href="leilao.php">Leilão</a>
      <a class="nav-item nav-link" href="historicoC.php">Historico de vendas</a>
      
      <a class="nav-item nav-link" href="meusleiloes.php">Meus leiloes</a>
  
      <a class="nav-item nav-link" href="categoria.php">Anuncio por categoria</a>
      
      <a class="nav-item nav-link my-2 my-sm-0" href="sair.php" style="margin:right;">Sair</a>
      
    </div>
  </div>
</nav>';

echo "Olá, ". $_SESSION['nome'];

?>