<?php
	ob_start();
	function inserirComentario($conexao) {
		if(!empty($_POST['comentario'])){

			$comentario = $_POST['comentario'];
			$idUser = $_SESSION['id'];
			$username = $_SESSION["username"];			
			$id = base64_encode($_SESSION['id_filme_serie']);

			$sql = "INSERT INTO comentario (Usuarios_id, Usuarios_username, FilmeSerie_idFilme, comentario, created) 
			VALUES 	('$idUser', '$username', "  . $_SESSION['id_filme_serie'] . ", '$comentario', now() )";
			$result = $conexao->query($sql);

			header("Location: verFilme.php?id=$id");
			exit();
		}
	}
?>