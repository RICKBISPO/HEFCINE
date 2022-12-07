<?php
	session_start();
	include_once("config.php");

	if(!empty($_POST['estrela'])){
		$estrela = $_POST['estrela'];
		$id = base64_encode($_SESSION['id_filme_serie']);

		$sql = "INSERT INTO pontuacao (Usuarios_id, FilmeSerie_idFilme, qnt_estrela, created) VALUES (" . $_SESSION['id'] . ", "  . $_SESSION['id_filme_serie'] . ", " . $estrela . ", now() )";
		
		//Salvar no banco de dados
		$result_avaliacos = $sql ; 
		$resultado_avaliacos = mysqli_query($conexao, $result_avaliacos);

			if(mysqli_insert_id($conexao)){
				$_SESSION['msg'] = "Avaliação cadastrada com sucesso";
				header("Location: verFilme.php?id=$id");
			}else{
				$_SESSION['msg'] = "Erro";
				header("Location: verFilme.php?id=$id");
			}
			exit();
	}else{
		$id = base64_encode($_SESSION['id_filme_serie']);
		$_SESSION['msg'] = "Selecione ao menos 1 estrela";
		header("Location: verFilme.php?id=$id");
		}
	
	?>