<?php
// Inicialize a sessão
session_start();
 
// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}



?>


<?php
      include_once('config.php');
      // recuperando a informaçăo da URL
      // verifica se parâmetro está correto e dento da normalidade 
      if(isset($_GET['id']) && is_numeric(base64_decode($_GET['id']))){
              $id = base64_decode($_GET['id']);
      } else {
          header('Location: index.php');
      }
      // realizando a pesquisa com o id recebido
      $query = mysqli_query($conexao,"select * from filmeserie where tipo= 'filme' and idFilmeSerie = $id");
      if (!$query) {
          die('Query Inválida: ' . @mysqli_error($conexao));  
      }
      $dados=mysqli_fetch_array($query);

      if (empty($dados['foto'])){
        $foto = 'SemImagem.png';
        }else{
          $foto = $dados['foto'];
        }
  ?>


<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="stylemain.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="imghef/hefcinelogo.png">
    <title>HEFcine</title>
  </head>
  <body>

  <!---NAVBAR-->
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #862123; padding-left: 20px;">
    <div class="container-fluid">
      <nav class="navbar">
        <a  href="welcome.php">
        <img src="imghef/hefcinelogo2.png" width="75" height="50" alt="HEFCINE ">
        </a>
      </nav>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item " >
            <a class="nav-link" id="underline" href="welcome.php" style="color: white; padding-left: 25px;">Página Inicial</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="underline" href="filme.php" style="color: white">Filmes</a>
          </li>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="underline" href="serie.php" style="color: white">Séries</a>
          </li>
          </li> 
        </ul>

<div class="dropdown dropstart">
              <a class="navbar-brand dropdown-toggle" href="#" data-bs-toggle="dropdown" style="padding-left: 20px;">
                <img src="imghef/profile.jpg" alt="Perfil" style="width:40px;" class="rounded-circle">
              </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
          <li><a class="dropdown-item" href="profile.php">Perfil</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
          </div>
          </div>
      </div>
    </div>
  </nav>

      <!-- Conteúdo do site--> 
      <div class="container" style="background-color: #e5edf0; padding-bottom: 300px; padding-top: 40px; padding-left: 40px;">
        <h1 style="text-align: center; text-transform: uppercase; padding-bottom: 45px;"><?php echo $dados['nome']?></h1>
          <div class="row ">
            <div class="col-sm-4">
              <p><?php echo "<img src='imghef/$foto' width='325px'";?></p>
            </div>
            <div class="col-sm-7">
              <p><strong>Genero: </strong><?php echo $dados['genero']?></p>
              <p><strong>Descrição: </strong><?php echo $dados['descricao']?></p>
              <p><img src='imghef/<?php echo $dados['faixaEtaria'] ?>'></p>
              <p><strong>Elenco: </strong><?php echo $dados['elenco']?></p>
              <p><strong>Diretor: </strong><?php echo $dados['diretor']?></p>
              <p><strong>Duração: </strong><?php echo $dados['duracao']?></p>
              <p><strong>Data de Lançamento: </strong><?php echo $dados['dataLancamento']?></p>
              <p><strong>Bilheteria: </strong><?php echo $dados['bilheteria']?></p>
              <a target="_blank" href="<?php echo $dados['ondeAssistir']?>"> <button type="button" class="btn-danger" id="btanimation">Assista Aqui</button></a>
              </div>
          </div>
          
          <BR>

    <!--COD ESTRELA-->      
    <div class="stars" data-rating="3">
        <span class="star">&nbsp;</span>
        <span class="star">&nbsp;</span>
        <span class="star">&nbsp;</span>
        <span class="star">&nbsp;</span>
        <span class="star">&nbsp;</span>
    </div>
   
    <!--SCRIPT ESTRELA-->
    <script>
        //initial setup
        document.addEventListener('DOMContentLoaded', function(){
            let stars = document.querySelectorAll('.star');
            stars.forEach(function(star){
                star.addEventListener('click', setRating); 
            });
            
            let rating = parseInt(document.querySelector('.stars').getAttribute('data-rating'));
            let target = stars[rating - 1];
            target.dispatchEvent(new MouseEvent('click'));
        });

        function setRating(ev){
            let span = ev.currentTarget;
            let stars = document.querySelectorAll('.star');
            let match = false;
            let num = 0;
            stars.forEach(function(star, index){
                if(match){
                    star.classList.remove('rated');
                }else{
                    star.classList.add('rated');
                }
                //are we currently looking at the span that was clicked
                if(star === span){
                    match = true;
                    num = index + 1;
                }
            });
            document.querySelector('.stars').setAttribute('data-rating', num);
        }
      </script>
      
      
         <!--TRAILER DO FILME-->
        <div style="text-align: center;">
          <h3>TRAILER DO FILME</h3>
          <BR> 
          <iframe width="1000" height="600"  src="<?php echo $dados['trailer']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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