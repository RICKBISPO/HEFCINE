
<?php
session_start();
include_once("config.php");

if(!empty($_POST['estrela'])){
	$estrela = $_POST['estrela'];

	$sql = "INSERT INTO pontuacao (Usuarios_id, FilmeSerie_idFilme, qnt_estrela, created) VALUES (" . $_SESSION['id'] . ", "  . $_SESSION['id_filme_serie'] . ", " . $estrela . ", now() )";
	
	//Salvar no banco de dados
	$result_avaliacos = $sql ; //"INSERT INTO pontuacao (Usuarios_id, FilmeSerie_idFilme, qnt_estrela, created) VALUES ('$_SESSION["id"]', '$_SESSION["id_filme_serie"]', '$estrela', NOW())";
	try{
		$resultado_avaliacos = mysqli_query($conexao, $result_avaliacos);
	}catch(Exception $e){
		var_dump($e);
		if(mysqli_insert_id($conexao)){
			$_SESSION['msg'] = "Avaliação cadastrada com sucesso";
			header("Location: verSerie.php?id=$id");
		}else{
			$_SESSION['msg'] = "Somente uma avaliação por pessoa";
			header("Location: verSerie.php?id=$id");
		}
		exit();
	}
		
}else{
	$_SESSION['msg'] = "Necessário selecionar pelo menos 1 estrela";
	header("Location: verSerie.php?id=$id");


}