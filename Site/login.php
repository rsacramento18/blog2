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
<link rel="stylesheet" href="css/main.css" type="text/css" />
 
</head>
 
<body>
<?php

    if(!(isset($_POST['user'], $_POST['password']))) { ?>

        <div class="container erro">
            <div class="row">
                <div class="col-lg-12">
                    <h1>ups...nao deu</h1>
                    <p>Tenta novamente por favor.</p></br>
                    <a href="index.php">Voltar</a>
                </div>
            </div>
        </div>
    <?php
    }
    else {
        if(login($_POST['user'],$_POST['password'], $dbc)==true) {
            
            header('Location: escrever.php');
        }
        else{
    ?>
        <div class="container erro">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Username ou password incorretos</h1>
                    <p>Tente novamente por favor.</p></br>
                    <a href="index.php">Voltar</a>
                </div>
            </div>
        </div>
    <?php
        }
    }
    ?>
</body>
</html>
    
