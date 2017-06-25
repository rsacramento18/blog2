<?php
include_once '../mysqlconfig.php';
include_once 'functions.php';
session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8" />
<title>Blog</title>
 
<link href="https://fonts.googleapis.com/css?family=Anaheim|Cutive+Mono" rel="stylesheet"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/main.css" type="text/css" /></head>
 
<body>

<?php
    

$error_msg = "";
if(isset($_POST['nome_user'], $_POST['p'], $_POST['confirmarPass'])){
    
    $user = filter_input(INPUT_POST, 'nome_user', FILTER_SANITIZE_STRING);

    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    echo $password;
    if (strlen($password) != 128) {
    	$error_msg .= '<p class="error">Invalid password configuration.</p>';
    }

    if(empty($error_msg)) {
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
      
        $password = hash('sha512', $password . $random_salt);

        $query = "INSERT INTO users ( nome_user , password, salt) 
        VALUES ( '$user', '$password', '$random_salt')";

         
        if($stmt = @mysqli_query($dbc, $query)) {
        ?>
            <div class="container" id="header">
                <div class="row">
                    <div class="col-lg-12">         
                        <h1>Sucesso!</h1>
                        <p>Sucesso na criacao da nova conta.</p></br>
                        <a href="administracao.php">Voltar</a>
                    </div>
                </div>
            </div>

        <?php
        
        }
        else{ ?>

             <div class="container" id="header">
                <div class="row">
                    <div class="col-lg-12">         
                        <h1>Erro!</h1>
                        <p>Houve um erro na criacao da nova conta. tente novamente</p></br>
                        <a href="administracao.php">Voltar</a>
                    </div>
                </div>
            </div>
        <?php
        }
    }
}

?>
<body>
</html>
