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
  include 'comentarioSerie.php';
  date_default_timezone_set('America/Sao_Paulo');
?>

<?php
  include_once('config.php');

  if(isset($_GET['id']) && is_numeric(base64_decode($_GET['id']))){
    $id = base64_decode($_GET['id']);
    $_SESSION["id_filme_serie"] = $id;
  } 
  else {
    header('Location: welcome.php');
  }

  $query = mysqli_query($conexao,"select * from filmeserie where tipo= 'serie' and idFilmeSerie = $id");
  $dados=mysqli_fetch_array($query);
  $foto = $dados['foto'];
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
    <title>HEFcine - Descrição da Série</title>
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
              <a class="nav-link" id="underline" href="ListaFilme.php" style="color: white">Filmes</a>
            </li>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="underline" href="ListaSerie.php" style="color: white">Séries</a>
            </li>
            </li> 
          </ul>
          <div class="dropdown dropstart">
            <a class="navbar-brand dropdown-toggle" href="#" data-bs-toggle="dropdown" style="padding-left: 20px;">
              <img src="imghef/suspeito.png" alt="Perfil" style="width:40px;" class="rounded-circle" title="<?php echo $_SESSION["id"]; ?>" >
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
              <li><a class="dropdown-item" href="profile.php">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout.php">Sair da conta</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- Conteúdo do site--> 
    <div class="container" style="background-color: #e5edf0; padding-bottom: 300px; padding-top: 40px; padding-left: 40px;">
      <h1 style="text-align: center; text-transform: uppercase; padding-bottom: 45px;"><?php echo $dados['nome']?></h1>
      <div class="row ">
        <div class="col-sm-4">
          <p><?php echo "<img src='imghef/$foto' width='355px'";?></p>
        </div>
        <div class="col-sm-7">
          <p><strong>Genero: </strong><?php echo $dados['genero']?></p>
          <p><strong>Descrição: </strong><?php echo $dados['descricao']?></p>
          <p><img src='imghef/<?php echo $dados['faixaEtaria']?>'></p>
          <p><strong>Elenco: </strong><?php echo $dados['elenco']?></p>
          <p><strong>Diretor: </strong><?php echo $dados['diretor']?></p>
          <p><strong>Número de temporadas: </strong><?php echo $dados['duracao']?></p>
          <p><strong>Data de Lançamento: </strong><?php echo $dados['dataLancamento']?></p>
          <p><strong>Avaliação:</strong>
            <?php
              $query="select AVG(qnt_estrela) as avgEstrela from pontuacao where FilmeSerie_idFilme='$id' ";
              $res=mysqli_query($conexao, $query);
              $data=mysqli_fetch_array($res);

              echo number_format($data['avgEstrela'], 1);
            ?>
          </p>
          <a target="_blank" href="<?php echo $dados['ondeAssistir']?>"><button type="button" class="btn-danger" id="btanimation">Assista Aqui</button></a>
        </div>
      </div><br>

      <!--TRAILER DA SERIE-->
      <div style="text-align: center;">
        <h3 >TRAILER DA SÉRIE</h3>
        <BR>
        <iframe width="1000" height="600"  src="<?php echo $dados['trailer']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div><br><br><br>
      
      <!--Avaliaçao e Comentario--> 
      <div style="text-align: center">


        <h3>AVALIAÇÃO:</h3><br>
        <?php
          if(isset($_SESSION['msg'])){
            echo $_SESSION['msg']."<br><br>";
            unset($_SESSION['msg']);
          }
        ?>   
        <form method="POST" action="pontuacaoSerie.php" enctype="multipart/form-data">
          <div class="estrelas">
            <input type="radio" id="vazio" name="estrela" value="" checked>
              
            <label for="estrela_um"><i class="fa fa-3x"></i></label>
            <input type="radio" id="estrela_um" name="estrela" value="1">

            <label for="estrela_dois"><i class="fa fa-3x"></i></label>
            <input type="radio" id="estrela_dois" name="estrela" value="2">
              
            <label for="estrela_tres"><i class="fa fa-3x"></i></label>
            <input type="radio" id="estrela_tres" name="estrela" value="3">
              
            <label for="estrela_quatro"><i class="fa fa-3x"></i></label>
            <input type="radio" id="estrela_quatro" name="estrela" value="4">
              
            <label for="estrela_cinco"><i class="fa fa-3x"></i></label>
            <input type="radio" id="estrela_cinco" name="estrela" value="5"><br><br>
              
            <button class="btn-danger" id="btanimation" type="submit" value="Cadastrar">Avaliar</button>
              
          </div>
        </form><br><br><br><br>


        <h3>COMENTÁRIO:</h3><br>
        <?php
          ob_start();
          echo "<form method='POST' action='".inserirComentario($conexao)."'>
          <textarea  name='comentario'></textarea><br>
          <button class='btn-danger' id=''btanimation' type='submit' name='commentSubmit'>Comentar</button>
          </form>";
        ?>

      </div><br><br>

      <!--Exibir comentarios--> 
      <?php
        ob_start();
          include_once('config.php');
          // ajustando a instruçăo select para ordenar por produto
          $query = mysqli_query($conexao,"select * from comentario where FilmeSerie_idFilme=$id order by created DESC;");
      
          if (!$query) {
              die('Query Inválida: ' . @mysqli_error($conexao));  
          }
      
          while($dados=mysqli_fetch_array($query)) 
          {
              echo "<div class='comment-box'><p>";
              echo "<p class='usuario'><strong>".(ucfirst($dados['Usuarios_username']))."</strong></p>";
              echo $dados['comentario']."<br><br>";
              $date = new DateTime($dados['created']);
              echo "<p class='horario'>".$date->format('d/m/Y H:i')."</p>";
              echo "</p></div>";
          }                
      ?>
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