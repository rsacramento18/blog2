<?php
include_once '../mysqlconfig.php';
include_once 'functions.php';
session_start();

if(isset($_SESSION['user'])) {

    if(isset($_POST['id_userForm'], $_POST['tituloForm'],$_POST['subtituloForm'], $_POST['escrever'])){


        $id_user= filter_input(INPUT_POST, 'id_userForm', FILTER_SANITIZE_NUMBER_INT);

        $titulo = filter_input(INPUT_POST, 'tituloForm', FILTER_SANITIZE_STRING);
        
        $subtitulo = filter_input(INPUT_POST, 'subtituloForm', FILTER_SANITIZE_STRING);
        $textarea = $_POST['escrever'];


        $query = "INSERT INTO post (titulo, sub_titulo, artigo, id_user) VALUES ('$titulo', '$subtitulo', '$textarea', $id_user)";
        if($stmt = @mysqli_query($dbc, $query)) {
            
            header('Location: index.php');
        }
        else {?>
            <div class="container erro">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>erro!</h1>
                        <p>Erro na insercao dos dados. Por tente novamente.</p></br>
                        <a href="index.php">voltar</a>
                    </div>
                </div>
            </div>

            
        <?php
        }


    }
    else { 
    ?>
        <div class="container erro">
            <div class="row">
                <div class="col-lg-12">
                    <h1>erro!</h1>
                    <p>Erro de sistema. Por favor tente novamente.</p></br>
                    <a href="index.php">voltar</a>
                </div>
            </div>
        </div>
    <?php
    }
}
else {
?>
    <div class="container erro">
        <div class="row">
            <div class="col-lg-12">
                <h1>erro!</h1>
                <p>nao pode ver esta pagina. por favor faca login e tente novamente.</p></br>
                <a href="index.php">voltar</a>
            </div>
        </div>
    </div>

<?php

}


?>
