<?php
include_once '../mysqlconfig.php';
include_once 'functions.php';
session_start();

if(isset($_SESSION['user'])) {

    if(isset($_POST['id_userForm'],$_POST['primeiro_nomeForm'],$_POST['ultimo_nomeForm'], $_POST['emailForm'],$_POST['textareaForm'], $_POST['letraForm'], $_POST['corForm'])){


        $id_user= filter_input(INPUT_POST, 'id_userForm', FILTER_SANITIZE_NUMBER_INT);

        $primeiro_nome = filter_input(INPUT_POST, 'primeiro_nomeForm', FILTER_SANITIZE_STRING);
        
        $ultimo_nome = filter_input(INPUT_POST, 'ultimo_nomeForm', FILTER_SANITIZE_STRING);

        $email = filter_input(INPUT_POST, 'emailForm', FILTER_SANITIZE_EMAIL);

        $textarea = $_POST['textareaForm'];

        $letra = $_POST['letraForm'];
        $cor = $_POST['corForm'];

        $query = "SELECT letra_id FROM letras where letra='$letra'";
        $letra_id = 0;
        if($stmt = @mysqli_query($dbc, $query)) {
            $letras = mysqli_fetch_array($stmt);
            if($letras['letra_id']>0 && $letras['letra_id']<26){
                $letra_id = $letras['letra_id'];
            }
        }

        $query = "SELECT cor_id FROM cores where valor_hex='$cor'";
        $cor_id = 0;
        if($stmt = @mysqli_query($dbc, $query)) {
            $cores = mysqli_fetch_array($stmt);
            if($cores['cor_id']>0 && $cores['cor_id']<26){
                $cor_id = $cores['cor_id'];
            }
        }

        $query = "UPDATE escritores SET primeiro_nome='$primeiro_nome', ultimo_nome='$ultimo_nome', email='$email', sobre_mim='$textarea', letra_id=$letra_id, cor_id=$cor_id WHERE id_user=$id_user";
        if($stmt = @mysqli_query($dbc, $query)) {
            
            header('Location: sobre_mim.php');
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
