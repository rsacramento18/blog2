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
<script type="text/JavaScript" src="js/sha512.js"></script> 
 
</head>
 
<body>
<?php
    if(isset($_SESSION['user']) && $_SESSION['user']=='ricardo') {

?>  
    
    <div class="container" id="header">
        <div class="row">
            <div class="col-lg-12">
                <div id="nav2">
                    <ul class="list-inline">
                        <li><a href="index.php">BLOG</a></li>
                        <li><a href="escrever.php">ESCREVER</a></li>
                        <li><a href="os_meus_posts.php">OS MEUS POSTS</a></li>
                        <li><a href="sobre_mim.php">SOBRE MIM</a></li>
                        <?if($_SESSION['user']=='ricardo'):?>
                        <li><a href="administracao.php" class="selected">ADMINISTRACAO</a></li>
                        <?php endif;?>

                        <li><a href="sair.php">SAIR</a></li>
                    </ul>
                </div>
            </div>

            <div id="logo"  class="col-lg-4 col-lg-offset-4">
                <div id="text-logo" class="text-center">
                    <h1>de A a Z</h1>
                </div>
                
                
            </div>
        </div>
    </div>

    <div class="container">


        <div class="row">
            <div class="col-lg-12 ">
                <h1 class="postTittle">Contas</h1>
                <?php

                $query = "SELECT * FROM users";

                echo "<div id='administracaoContas'>";

	            if($stmt = @mysqli_query($dbc, $query)) {
                    while( $row = mysqli_fetch_array($stmt)) {
                        echo "<div class='col-lg-2' id='contas'>";
                            $nome_user = $row['nome_user'];
                            echo "<p>$nome_user</p>";
                        echo "</div>";

		            
                    }
	            }
                echo "</div>";
                ?>
            </div>

            <div class="col-lg-12">
                <h1 class="postTittle">Criar nova conta</h1>
                <form method="post" action="criarConta.php" name="criarContaForm" id="criarContaForm"/>
                    <input type="text" name="nome_user" id="nome_user" placeholder="Username"/>
                    <input type="text" name="passwordCriarConta" id="passwordCriarConta" placeholder="Password"/>
                    <input type="text" name="confirmarPass" id="confirmarPass" placeholder="Confirmar Password"/></br>
                    <input type="button" value="Criar Conta" name="btCriarConta" id="btCriarConta" onclick="regformhash(this.form,
						this.form.nome_user,
						this.form.passwordCriarConta,
						this.form.confirmarPass);"/>
                </form>

            </div>



        </div>
    </div>

	<script type="text/javascript">
    function regformhash(form, user, password, conf) {

	// Check each field has a value
    if (user.value === ''          || 
        	password.value === ''  || 
        	conf.value === '') {
 
        alert('Tem que fornecer todos os dados. Por favor tente outra vez');
        return false;
    }

    if (password.value.length < 6) {
        alert('Passwords tem que ter pelo menos 6 caracteres.  Por favor tente outra vez.');
        form.password.focus();
        return false;
    }

    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert('Passwords tem que conter pelo menos um numero, uma letra minuscula e uma letra maiuscula. Por favor tente outra vez.');
        return false;
    }

    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('A sua Password e Confirmacao nao correspondem. Por favor tente outra vez.');
        form.password.focus();
        return false;
    }
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
    
    // Add the new element to our form. 
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
    //p.value = password.value;
    //hex_sha512(p.value);
    form.appendChild(p);

    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
    conf.value = "";

    // Finally submit the form. 
    form.submit();
    return true;
}


    </script>


<?php
    }
    else {
?>
    
        <div class="container erro">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Erro!</h1>
                    <p>Nao pode ver esta pagina. Por favor faca login e tente novamente.</p></br>
                    <a href="index.php">Voltar</a>
                </div>
            </div>
        </div>
<?php
    }
?>
</body>
</html>
