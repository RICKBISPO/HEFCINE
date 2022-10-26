<?php
  // Inicialize a sessão
  session_start();
  
  // Verifique se o usuário está logado, se não, redirecione-o para uma página de login
  if(isset($_SESSION["loggedin"]) ){
    if($_SESSION["loggedin"] === true){
      header("location: welcome.php");
      exit;
    }
  }
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="stylemain.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="imghef/hefcinelogo.png">
    <title>HEFcine</title>
    </style>
  </head>
  <body>
    
    <!---NAVBAR-->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #862123; padding-left: 20px;">
      <div class="container-fluid">
        <nav class="navbar">
          <a  href="login.php" >
          <img src="imghef/hefcinelogo2.png" width="75" height="50" alt="HEFCINE ">
          </a>
        </nav>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item " >
              <a class="nav-link" id="underline" href="index.php"  style="color: white; padding-left: 25px;">Página Inicial</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="underline" href="filme.php" style="color: white">Filmes</a>
            </li>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="underline" href="serie.php"  style="color: white">Séries</a>
            </li>
            </li> 
          </ul>
          <span class="navbar-item" style="color: white; padding-right: 25px;">
          <a class="nav-link " href="register.php" style="color: white; text-align: left">Registrar-se</a> </span>
        <span class="navbar-item" style="color: white">
          <a class="nav-link" href="login.php" style="color: white; padding-right: 40px;" >Login</a></span>
          </div>
        </div>
      </div>
    </nav>

    <!--Conteudo do site-->
    <div class="container " style="background-color: #e5edf0; padding-top: 20px;">

      <!--CARROSSEL-->
      <div id="demo" class="carousel w-75 mx-auto" data-bs-ride="carousel" >
        <!-- Indicadores do Carrossel -->
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
          <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
          <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
        </div>
        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
          <div class="carousel-item active">
             <img src="imghef/confianopai.png" alt="slide1" class="d-block w-100 h-50">
          </div>
          <div class="carousel-item">
            <img src="imghef/confianopai.png" alt="slide2" class="d-block w-100 h-50">
          </div>
          <div class="carousel-item">
            <img src="imghef/confianopai.png" alt="slide3" class="d-block w-100">
          </div>
        </div>
        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>

        <!--Display de Filmes/Series -->
      <div class="container" style="background-color: #e5edf0; padding-bottom: 25px; padding-top: 50px;">
            
        <!--Filmes-->
        <h5>Filmes do Momento:</h5>
        <div class="row">
          <div class="col mb-4">
            <div class="card" style="width: 14rem">
              <div class="card-img-top text-center pt-2" >
                <?php
                  include_once('config.php');
                              
                  // ajustando a instruçăo select para ordenar por produto
                  $query = mysqli_query($conexao,"select * from filmeserie where idFIlmeSerie= '1' and tipo= 'filme'");
                          
                  if (!$query) {
                      die('Query Inválida: ' . @mysqli_error($conexao));  
                  }
                          
                  while($dados=mysqli_fetch_array($query)) 
                    {

                      // buscando a na pasta imagem
                      if (empty($dados['foto'])){
                        $foto = 'SemImagem.png';
                    }else{
                        $foto = $dados['foto'];
                    }
                    $idFilmeSerie = base64_encode($dados['idFilmeSerie']);
                      echo "<a href='verFilme.php?id=$idFilmeSerie' align='center'><img src='imghef/$foto' width='200px' height='300px'></a>";
                      echo "<h5>". $dados['nome']."</h5>";
                  } 
                ?>
              </div>
            </div>
          </div>
          <div class="col mb-4">
            <div class="card" style="width: 14rem;">
              <div class="card-img-top text-center pt-2" >
                <?php
                  include_once('config.php');
                              
                  // ajustando a instruçăo select para ordenar por produto
                  $query = mysqli_query($conexao,"select * from filmeserie where idFIlmeSerie= '2' and tipo= 'filme'");
                          
                  if (!$query) {
                      die('Query Inválida: ' . @mysqli_error($conexao));  
                  }
                          
                  while($dados=mysqli_fetch_array($query)) 
                  {


                      // buscando a na pasta imagem
                      if (empty($dados['foto'])){
                        $foto = 'SemImagem.png';
                    }else{
                        $foto = $dados['foto'];
                    }
                    $idFilmeSerie = base64_encode($dados['idFilmeSerie']);
                      echo "<a href='verFilme.php?id=$idFilmeSerie' align='center'><img src='imghef/$foto' width='200px' height='300px'></a>";
                      echo "<h5>". $dados['nome']."</h5>";
                  } 
                ?>
              </div>
            </div>
          </div>
          <div class="col mb-4">
            <div class="card"  style="width: 14rem;">
              <div class="card-img-top text-center pt-2" >
                  <?php
                        include_once('config.php');
                        
                        // ajustando a instruçăo select para ordenar por produto
                        $query = mysqli_query($conexao,"select * from filmeserie where idFIlmeSerie= '3' and tipo= 'filme'");
                    
                        if (!$query) {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }
                    
                        while($dados=mysqli_fetch_array($query)) 
                        {


                            // buscando a na pasta imagem
                            if (empty($dados['foto'])){
                              $foto = 'SemImagem.png';
                          }else{
                              $foto = $dados['foto'];
                          }
                          $idFilmeSerie = base64_encode($dados['idFilmeSerie']);
                            echo "<a href='verFilme.php?id=$idFilmeSerie' align='center'><img src='imghef/$foto' width='200px' height='300px'></a>";
                            echo "<h5>". $dados['nome']."</h5>";
                        } 
                  ?>
              </div>
            </div>
          </div>
          <div class="col mb-4">
            <div class="card"  style="width: 14rem;">
              <div class="card-img-top text-center pt-2" >
                  <?php
                        include_once('config.php');
                        
                        // ajustando a instruçăo select para ordenar por produto
                        $query = mysqli_query($conexao,"select * from filmeserie where idFIlmeSerie= '4' and tipo= 'filme'");
                    
                        if (!$query) {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }
                    
                        while($dados=mysqli_fetch_array($query)) 
                        {

                            // buscando a na pasta imagem
                            if (empty($dados['foto'])){
                              $foto = 'SemImagem.png';
                          }else{
                              $foto = $dados['foto'];
                          }
                          $idFilmeSerie = base64_encode($dados['idFilmeSerie']);
                            echo "<a href='verFilme.php?id=$idFilmeSerie' align='center'><img src='imghef/$foto' width='200px' height='300px'></a>";
                            echo "<h5>". $dados['nome']."</h5>";
                        } 
                  ?>
              </div>
            </div>
          </div>
          <div class="col mb-4">
            <div class="card" style="width: 14rem;">
              <div class="card-img-top text-center pt-2" >
                  <?php
                        include_once('config.php');
                        
                        // ajustando a instruçăo select para ordenar por produto
                        $query = mysqli_query($conexao,"select * from filmeserie where idFIlmeSerie= '5' and tipo= 'filme'");
                    
                        if (!$query) {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }
                    
                        while($dados=mysqli_fetch_array($query)) 
                        {


                            // buscando a na pasta imagem
                            if (empty($dados['foto'])){
                              $foto = 'SemImagem.png';
                          }else{
                              $foto = $dados['foto'];
                          }
                          $idFilmeSerie = base64_encode($dados['idFilmeSerie']);
                            echo "<a href='verFilme.php?id=$idFilmeSerie' align='center'><img src='imghef/$foto' width='200px' height='300px'></a>";
                            echo "<h5>". $dados['nome']."</h5>";
                        } 
                  ?>
              </div>
            </div>
          </div>
        </div>
    
        <!--Display de Séries -->
        <h5>Melhores Séries:</h5>
        <div class="row">
          <div class="col mb-4">
            <div class="card"  style="width: 14rem;">
              <div class="card-img-top text-center pt-2" >
                  <?php
                    include_once('config.php');
                    
                    // ajustando a instruçăo select para ordenar por produto
                    $query = mysqli_query($conexao,"select * from filmeserie where idFIlmeSerie= '6' and tipo= 'serie'");
                
                    if (!$query) {
                        die('Query Inválida: ' . @mysqli_error($conexao));  
                    }
                
                    while($dados=mysqli_fetch_array($query)) 
                    {


                        // buscando a na pasta imagem
                        if (empty($dados['foto'])){
                          $foto = 'SemImagem.png';
                      }else{
                          $foto = $dados['foto'];
                      }
                      $id = base64_encode($dados['idFilmeSerie']);
                        echo "<a href='verSerie.php?id=$id' align='center'><img src='imghef/$foto' width='200px' height='300px'></a>";
                        echo "<h5>". $dados['nome']."</h5>";
                    } 
                    ?>
              </div>
            </div>
          </div>
          <div class="col mb-4">
            <div class="card"  style="width: 14rem;">
              <div class="card-img-top text-center pt-2" >
                  <?php
                        include_once('config.php');
                        
                        // ajustando a instruçăo select para ordenar por produto
                        $query = mysqli_query($conexao,"select * from filmeserie where idFIlmeSerie= '7' and tipo= 'serie'");
                    
                        if (!$query) {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }
                    
                        while($dados=mysqli_fetch_array($query)) 
                        {


                            // buscando a na pasta imagem
                            if (empty($dados['foto'])){
                              $foto = 'SemImagem.png';
                          }else{
                              $foto = $dados['foto'];
                          }
                          $id = base64_encode($dados['idFilmeSerie']);
                            echo "<a href='verSerie.php?id=$id' align='center'><img src='imghef/$foto' width='200px' height='300px'></a>";
                            echo "<h5>". $dados['nome']."</h5>";
                        } 
                  ?>
              </div>
            </div>
          </div>
          <div class="col mb-4">
            <div class="card"  style="width: 14rem;">
              <div class="card-img-top text-center pt-2" >
                  <?php
                        include_once('config.php');
                        
                        // ajustando a instruçăo select para ordenar por produto
                        $query = mysqli_query($conexao,"select * from filmeserie where idFIlmeSerie= '8' and tipo= 'serie'");
                    
                        if (!$query) {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }
                    
                        while($dados=mysqli_fetch_array($query)) 
                        {


                            // buscando a na pasta imagem
                            if (empty($dados['foto'])){
                              $foto = 'SemImagem.png';
                          }else{
                              $foto = $dados['foto'];
                          }
                          $id = base64_encode($dados['idFilmeSerie']);
                            echo "<a href='verSerie.php?id=$id' align='center'><img src='imghef/$foto' width='200px' height='300px'></a>";
                            echo "<h5>". $dados['nome']."</h5>";
                        } 
                  ?>
              </div>
            </div>
          </div>
          <div class="col mb-4">
            <div class="card"  style="width: 14rem;">
              <div class="card-img-top text-center pt-2" >
                  <?php
                        include_once('config.php');
                        
                        // ajustando a instruçăo select para ordenar por produto
                        $query = mysqli_query($conexao,"select * from filmeserie where idFIlmeSerie= '9' and tipo= 'serie'");
                    
                        if (!$query) {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }
                    
                        while($dados=mysqli_fetch_array($query)) 
                        {


                            // buscando a na pasta imagem
                            if (empty($dados['foto'])){
                              $foto = 'SemImagem.png';
                          }else{
                              $foto = $dados['foto'];
                          }
                          $id = base64_encode($dados['idFilmeSerie']);
                            echo "<a href='verSerie.php?id=$id' align='center'><img src='imghef/$foto' width='200px' height='300px'></a>";
                            echo "<h5>". $dados['nome']."</h5>";
                        } 
                  ?>
              </div>
            </div>
          </div>
          <div class="col mb-4">
            <div class="card"  style="width: 14rem;">
              <div class="card-img-top text-center pt-2" >
                  <?php
                        include_once('config.php');
                        
                        // ajustando a instruçăo select para ordenar por produto
                        $query = mysqli_query($conexao,"select * from filmeserie where idFIlmeSerie= '10' and tipo= 'serie'");
                    
                        if (!$query) {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }
                    
                        while($dados=mysqli_fetch_array($query)) 
                        {


                            // buscando a na pasta imagem
                            if (empty($dados['foto'])){
                              $foto = 'SemImagem.png';
                          }else{
                              $foto = $dados['foto'];
                          }
                          $id = base64_encode($dados['idFilmeSerie']);
                            echo "<a href='verSerie.php?id=$id' align='center'><img src='imghef/$foto' width='200px' height='300px'></a>";
                            echo "<h5>". $dados['nome']."</h5>";
                        } 
                  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<!--Rodapé do Site-->
<footer class="bg-dark text-light">
            <ul style="text-align: center;">
              <a href="https://www.instagram.com/hefcine_/" target="_blank" ><img src="imghef/insta.png" style="width:50px; height: 50px; margin: 20px; "></a>
              <a href="https://twitter.com/hefcine" target="_blank" ><img src="imghef/twitter.png" style="width:51px; height: 51px; margin: 20px; ;"></a>
              <a href="https://www.instagram.com/fehh.inacio/" target="_blank" ><img src="imghef/inas.png" style="width:60px; height: 60px; margin: 20px; border-radius: 50%;  -webkit-filter: grayscale(100%); filter: grayscale(100%);"></a>
              <a href="https://www.instagram.com/edenilson_ju/" target="_blank" ><img src="imghef/edson.png" style="width:60px; height: 60px; margin: 20px; border-radius: 50%;  -webkit-filter: grayscale(100%); filter: grayscale(100%);"></a>
              <a href="https://www.instagram.com/henrique.bispo_/" target="_blank" ><img src="imghef/rick.png" style="width:60px; height: 60px; margin: 20px; border-radius: 50%;  -webkit-filter: grayscale(100%); filter: grayscale(100%);"></a>
            </ul>
      <div class="text-center" style="background-color: #333; padding: 10px;" > &copy HEFCINE: Todos os direitos reservados </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>