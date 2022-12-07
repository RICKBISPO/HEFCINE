<?php
require_once "configlogin.php";
 
//Definir usuario e senha como vazio
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Dados do formulário quando o formulário é enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validar nome de usuário (trim serve para remover os espaços tanto da direita como da esquerda)
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor coloque um nome de usuário.";

        //Se o usuario conter caracteres diferentes de "a-zA-Z0-9", exibe um erro 
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "O nome de usuário pode conter apenas letras, números e sublinhados";
    } else{


        $sql = "SELECT id FROM usuario WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_username = trim($_POST["username"]);
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "Este nome de usuário já está em uso";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde";
            }

            // Fechar declaração
            unset($stmt);
        }
    }
    
    // Validar senha
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor insira uma senha";     
    } elseif(strlen(trim($_POST["password"])) < 6){   //Se a senha nâo tiver no mínimo 6 caracteres, exibe o erro
        $password_err = "A senha deve ter pelo menos 6 caracteres";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Aba para validar e conferir a senha
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor, confirme a senha";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){ //Se a senha não conferir com a confirmação dela, exibe um erro
            $confirm_password_err = "A senha não confere";
        }
    }
    
    // Validar credenciais  (Se $username_err, $password_err e $confirm_password_err  forem diferentes de vazio, executa)
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        $sql = "INSERT INTO usuario (username, password) VALUES (:username, :password)";
         
        if($stmt = $pdo->prepare($sql)){
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Cria uma hash para a senha (encripta a senha)
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                // Redirecionar para a página de login
                header("location: login.php");
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde";
            }
            unset($stmt);
        }
    }
    
    // Fechar conexão
    unset($pdo);
}
?>
 

<!DOCTYPE html>
<html lang="pt-br">
        <head>
        <meta charset="UTF-8">
        <title>HEFcine - Cadastro</title>
        <link rel="stylesheet" href="stylelogs.css">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <link rel="icon" type="image/x-icon" href="imghef/hefcinelogo.png">
    </head>

    <body>
        <div id=telacentro>
        <a href="index.php">
            <img src="imghef/hefcineimg.png" alt="Logo do site" width="250" height="150">
        </a>
        <h1>Cadastro</h1>
        <!--- Formulário de Cadastro -->
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
                    <div>
                        <input type="password" name="confirm_password" placeholder="Confirmar Senha">
                        <span action="<?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>"><br>
                            <span>
                            <?php 
                                if(!empty($confirm_password_err)){
                                    echo '<div id="neonid" class="alerta error">' . $confirm_password_err . '</div>';
                                }        
                            ?>
                            </span><br>
                    </div>
                
            <!-- Botao de Cadastro / Apagar Dados -->
            <div>
                <button style="width: 148px;" type="submit" class="btn" value="Criar Conta" id="btanimation">Criar Conta</button>
                <button style="width: 148px;" type="reset" class="btn" value="Apagar Dados" id="btanimation">Apagar Dados</button>
            </div>
            <p>Já tem uma conta? <a href="login.php" style="color:#992225">Entre aqui</a></p>
            </form>
        </div>    
    </body>
</html>