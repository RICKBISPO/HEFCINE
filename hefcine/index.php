<?php

include ('php/funcoes.php');
session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/stylemain.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="imghef/hefcinelogo.png">
    <title>HEFcine - Página Principal</title>
    </style>
  </head>
<body>

  <!---Navbar-->
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <a href="index.php" ><img src="imghef/hefcinelogo2.png" class="logo" alt="HEFCINE "></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php" style="color: white; padding-left: 25px;">Página Inicial</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ListaFilme.php" style="color: white">Filmes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ListaSerie.php"  style="color: white">Séries</a>
          </li>
        </ul>
    </div>

    <!-- Verifica se o usuário está logado -->
    <?php if(isset($_SESSION["id"])) { ?>
    <div class="dropdown dropstart">
        <a class="navbar-brand dropdown-toggle" href="#" data-bs-toggle="dropdown" style="padding-left: 20px;">
            <img src="imghef/suspeito.png" alt="Perfil" style="width:40px;" class="rounded-circle" title="<?php echo $_SESSION["id"]; ?>" >
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
            <li><a class="dropdown-item" href="logout.php">Sair da conta</a></li>
        </ul>
    </div>

    <?php } else { ?>
      
    <span class="navbar-item" style="color: white; padding-right: 25px;">
      <a class="nav-link " href="register.php" style="color: white; text-align: left">Registrar-se</a>
    </span>
    <span class="navbar-item" style="color: white">
      <a class="nav-link" href="login.php" style="color: white; padding-right: 40px;" >Login</a>
    </span>
    <?php } ?>
    </div>
  </nav>

  <!--Conteudo do site-->
  <div class="container" >

    <!--Carrossel-->
    <div id="demo" class="carousel w-75 mx-auto" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
        <button data-bs-target="#demo" data-bs-slide-to="1"></button>
        <button data-bs-target="#demo" data-bs-slide-to="2"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="imghef/slide1.png" alt="slide1" class="d-block w-100">
        </div>
        <div class="carousel-item">
          <img src="imghef/slide2.png" alt="slide2" class="d-block w-100">
        </div>
        <div class="carousel-item">
          <img src="imghef/slide3.png" alt="slide3" class="d-block w-100">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>

    <!--Display de Filmes/Series -->
    <div class="containerFilmeSerie">

      <!--Filmes-->
      <h5>Filmes do Momento:</h5>
      <div class="row" style="padding-bottom: 45px">
        <?php exibirFilmesSeries('filme');?>
      </div>

      <!--Séries-->
      <h5>Melhores Séries:</h5>
      <div class="row" style="padding-bottom: 45px">
        <?php exibirFilmesSeries('serie');?>
      </div>

      <!--Novas Séries(2022) -->
      <h5>Melhores Séries e Filmes (2022):</h5>
      <div class="row" style="padding-bottom: 45px">
        <?php 
          exibirAno('serie', '2022');
          exibirAno('filme', '2022');
        ?>  
      </div>
    </div>
  </div>
  
  <!--Rodapé do Site-->
  <footer class="bg-dark text-light">
    <ul style="text-align: center;">
      <a href="https://www.instagram.com/hefcine_/" target="_blank" ><img src="imghef/insta.png" style="width:50px; height: 50px; margin: 20px; "></a>
      <a href="https://twitter.com/hefcine" target="_blank" ><img src="imghef/twitter.png" style="width:51px; height: 51px; margin: 20px; ;"></a>
      <a href="https://www.instagram.com/fehh.inacio/" target="_blank" ><img src="imghef/inas.png" style="width:60px; height: 60px; margin: 20px; border-radius: 50%;  -webkit-filter: grayscale(100%); filter: grayscale(100%);"></a>
      <a href="https://www.instagram.com/edenilson_ju/" target="blank" ><img src="imghef/edson.png" style="width:60px; height: 60px; margin: 20px; border-radius: 50%;  -webkit-filter: grayscale(100%); filter: grayscale(100%);"></a>
      <a href="https://www.instagram.com/henrique.bispo_/" target="_blank" ><img src="imghef/rick.png" style="width:60px; height: 60px; margin: 20px; border-radius: 50%;  -webkit-filter: grayscale(100%); filter: grayscale(100%);"></a>
    </ul>
    <div class="text-center" style="background-color: #333; padding: 10px;" > &copy HEFCINE: Todos os direitos reservados </div>
  </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>