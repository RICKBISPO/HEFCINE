<?php

include ('config.php');

global $conexao;

//funcao para verificar se esta logado
function verificarLogado(){
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
}

//funcao do index para exibir 5 filmes
function exibirFilmesSeries($tipo) {

    global $conexao;
    
    $query = "SELECT * FROM filmeserie where tipo= '$tipo' LIMIT 5";
    $res = mysqli_query($conexao, $query);

    while ($dados = mysqli_fetch_array($res)) {
        $foto = $dados['foto'];
        $id = base64_encode($dados['idFilmeSerie']);

        echo '<div class="col mb-4">';
        echo '<div class="card" style="width: 14rem">';
        echo '<div class="card-img-top text-center pt-2">';
        if ($tipo == 'filme') 
        {
            echo "<a href='verFilme.php?id=$id' align='center'><img src='imghef/$foto' width='200px' height='300px'></a>"; 
        } 
        else 
        {
            echo "<a href='verSerie.php?id=$id' align='center'><img src='imghef/$foto' width='200px' height='300px'></a>";
        }
        echo '<h5>' . $dados['nome'] . '</h5>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
    }
}

function exibirAno($tipo, $ano) {

    global $conexao;
    
    $query = "SELECT * FROM filmeserie where tipo= '$tipo' and anoLancamento = '$ano' LIMIT 5";
    $res = mysqli_query($conexao, $query);

    while ($dados = mysqli_fetch_array($res)) {
        $foto = $dados['foto'];
        $id = base64_encode($dados['idFilmeSerie']);

        echo '<div class="col mb-4">';
        echo '<div class="card" style="width: 14rem">';
        echo '<div class="card-img-top text-center pt-2">';
        if ($tipo == 'filme') 
        {
            echo "<a href='verFilme.php?id=$id' align='center'><img src='imghef/$foto' width='200px' height='300px'></a>"; 
        } 
        else 
        {
            echo "<a href='verSerie.php?id=$id' align='center'><img src='imghef/$foto' width='200px' height='300px'></a>";
        }
        echo '<h5>' . $dados['nome'] . '</h5>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
    }
}

function exibirComentarios($conexao, $id) {

    $query = mysqli_query($conexao, "SELECT * FROM comentario WHERE FilmeSerie_idFilme = $id ORDER BY created DESC;");

    if (!$query) {
        die('Query Inválida: ' . @mysqli_error($conexao));
    }

    while ($dados = mysqli_fetch_array($query)) {
        echo "<div class='comment-box'><p>";
        echo "<p class='usuario'><strong>" . (ucfirst($dados['Usuarios_username'])) . "</strong></p>";
        echo $dados['comentario'] . "<br><br>";
        $date = new DateTime($dados['created']);
        echo "<p class='horario'>" . $date->format('d/m/Y H:i') . "</p>";
        echo "</p></div>";
    }
}

?>
