<?php
// Inicialize a sessão
session_start();
 
// Verifique se o usuário já está logado, em caso afirmativo, redirecione-o para a página de boas-vindas
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
require_once "configlogin.php";
 
//Definir usuario e senha como vazio
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Dados do formulário quando o formulário é enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Verifique se o nome de usuário está vazio
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor, insira o nome de usuário.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Verifique se a senha está vazia     (trim serve para remover os espaços tanto da direita como da esquerda)
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor, insira sua senha.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validar credenciais  (Se o $username_err e o $password_err forem diferentes de vazio, executa)
    if(empty($username_err) && empty($password_err)){
        // Select do banco
        $sql = "SELECT id, username, password FROM usuario WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_username = trim($_POST["username"]);
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                // Verifique se o nome de usuário existe, se sim, verifique a senha
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];

                        // A senha está correta, então inicie uma nova sessão
                        if(password_verify($password, $hashed_password)){

                            session_start();
                            
                            // Armazene dados em variáveis de sessão
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            header("location: welcome.php");
                        } else{
                            $login_err = "Nome de usuário ou senha inválidos";
                        }
                    }
                } else{
                    $login_err = "Nome de usuário ou senha inválidos";
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
        unset($stmt);
        }
    }
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>HEFcine - Login</title>
        <link rel="stylesheet" href="stylelogs.css"> 
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <link rel="icon" type="image/x-icon" href="imghef/hefcinelogo.png">
    </head>

    <body>
        <div id=telacentro>
            <a href="index.php"><img src="imghef/hefcineimg.png" alt="Logo do site" width="250" height="150"></a>
            <h1>Login</h1>
        
            <!-- ALerta erro se estiver vazio -->
            <?php 
            if(!empty($login_err)){
                echo '<div id="neonid" class="alerta error">' . $login_err . '</div>';
            }        
            ?>
        <!--- Formulário de Login -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <input type="text" name="username" placeholder="Usuário">
                <br>
                <span action="<?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span>
                        <?php 
                            if(!empty($username_err)){
                                echo '<div id="neonid" class="alerta error">' . $username_err . '</div>';
                            }        
                        ?>
                    </span><br>
                    </div>    
                    <div>
                        <input type="password" name="password" placeholder="Senha">
                        <span action="<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                        <br>
                    <span>
                        <?php 
                            if(!empty($password_err)){
                                echo '<div id="neonid" class="alerta error">' . $password_err . '</div>';
                            }        
                        ?>
                    </span>
                    <br>
                    </div>
                
                
                <!-- Botão de login -->
                <div>
                    <button type="submit" class="btn" value="Entrar" id="btanimation">Entrar</button>
                </div>
                <p>Não tem uma conta? <a href="register.php" style="color:#992225">Inscreva-se agora</a></p>
            </form>
        </div>
    </body>
</html>