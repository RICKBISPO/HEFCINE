<?php
  // Inicialize a sessão
  session_start();
  
  // Verifique se o usuário está logado, se não, redirecione-o para uma página de login
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
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
    <title>HEFcine - Filmes</title>
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
              <li><a class="dropdown-item" href="logout.php">Sair da conta</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
      
    
    <!--Conteudo do site-->
    <div class="container" style="background-color: #e5edf0; padding-top: 10px;"> 
       
      <?php
        include_once('config.php');
        
        // ajustando a instruçăo select para ordenar por produto
        $query = mysqli_query($conexao,"select * from filmeserie where tipo= 'filme' order by genero ");
    
        if (!$query) {
            die('Query Inválida: ' . @mysqli_error($conexao));  
        }
    
        echo "<table class=\"table table-hover table-sm\">";
        echo "<thead>";
        echo "<tr>";
        echo "<th scope=\"col\" width='500px' align='center'>FILME</th>";
        echo "<th scope=\"col\" width='500px' align='center'>GÊNERO</th>";
        echo "<th scope=\"col\" width='500px' align='center'>FAIXA ETÁRIA</th>";
        echo "<th scope=\"col\" width='500px' align='center'>ㅤ</th>";
        echo "</tr>";
        echo "</thead>";
        
    
        while($dados=mysqli_fetch_array($query)) 
      
        {
            echo"<tbody>";
            echo "<tr>";
            echo "<td style=\"padding: 120px 0;\">". $dados['nome']."</td>";
            echo "<td style=\"padding: 120px 0;\">". $dados['genero']."</td>";
            ?>
              <td style="padding: 120px 0;"><img src='imghef/<?php echo $dados['faixaEtaria'] ?>'></td>

              <?php
            // buscando a na pasta imagem
            if (empty($dados['foto'])){
                $foto = 'SemImagem.png';
            }else{
                $foto = $dados['foto'];
            }
            $id = base64_encode($dados['idFilmeSerie']);
            echo "<td align='center'><a href='verFilme.php?id=$id'><img src='imghef/$foto' width='200px' ></a></td>";
            echo "</tr>";
            echo"</tbody>";
          }
          echo "</table>";
        
        mysqli_close($conexao);
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