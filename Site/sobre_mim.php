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
<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>.
<script>tinymce.init({ selector:'textareaForm' });</script>
<script src="https://code.jquery.com/jquery-3.0.0.js"></script>
</head>
 
<body>
<?php
    if(isset($_SESSION['user'])) {

?>
    <div class="container" id="header">
        <div class="row">
           <div class="col-lg-12"> 
            
                <div id="nav2">
                    <ul class="list-inline">
                        <li><a href="index.php">BLOG</a></li>
                        <li><a href="escrever.php">ESCREVER</a></li>
                        <li><a href="os_meus_posts.php">OS MEUS POSTS</a></li>
                        <li><a href="sobre_mim.php" class="selected">SOBRE MIM</a></li>
                        <?if($_SESSION['user']=='ricardo'):?>
                        <li><a href="administracao.php">ADMINISTRACAO</a></li>
                        <?php endif;?>
                        <li><a href="sair.php">SAIR</a></li>
                    </ul>
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
           <div class="col-lg-12  post" id="informacoesSobre_mim">
                <h1 class="postTittle">sobre mim</h1>
                <?php
                $user = $_SESSION['user'];
                $query = "SELECT escritores.primeiro_nome, escritores.ultimo_nome, escritores.email, escritores.sobre_mim,letras.letra, cores.valor_hex  FROM `escritores` 
                INNER JOIN users ON escritores.id_user = users.user_id 
                INNER JOIN letras ON escritores.letra_id = letras.letra_id 
                INNER JOIN cores ON escritores.cor_id = cores.cor_id
                WHERE users.nome_user = '$user'";

                echo "<div id='sobre_mimDiv'>";

	            if($stmt = @mysqli_query($dbc, $query)) {
                    $row = mysqli_fetch_array($stmt);
                    $primeiro_nome = $row['primeiro_nome'];
                    /* if($primeiro_nome != ''){ */


                        echo '<div class="col-lg-12">';
                            $hexValue = $row['valor_hex'];
                            echo '<div class="letraAutor" style="background-color:'. $hexValue . ';">';
                                $letra = $row['letra'];
                                echo '<div class="letra">'.$letra.'</div>';
                            echo '</div>';
                        echo '</div>';

                        echo "<div class='col-lg-2 labels'>"; 
                            echo "<p>Primeiro Nome</p>";
                        echo "</div>";
                        echo "<div class='col-lg-10 information'>"; 
                            echo "<p>$primeiro_nome</p>";
                        echo "</div>";



                        echo "<div class='col-lg-2 labels'>";
                            echo "<p>Ultimo Nome</p>";
                        echo "</div>";
                        echo "<div class='col-lg-10 information'>"; 
                            $ultimo_nome= $row['ultimo_nome'];
                            echo "<p>$ultimo_nome</p>";
                        echo "</div>";



                        echo "<div class='col-lg-2 labels'>";
                            echo "<p>Email</p>";
                        echo "</div>";
                        echo "<div class='col-lg-10 information'>"; 
                            $email= $row['email'];
                            echo "<p>$email</p>";
                        echo "</div>";



                        echo "<div class='col-lg-2 labels'>";
                            echo "<p>Sobre Mim</p>";
                        echo "</div>";
                        echo "<div class='col-lg-10 information'>"; 
                            $sobre_mim= $row['sobre_mim'];
                            echo "<p>$sobre_mim</p>";
                        echo "</div>";
                            
                            
                        



                    /* } */
                    
	            }
                echo "</div>";
                ?>
            </div>
            
            <div class="col-lg-12">
                <form action="sobre_mimUpdate.php" method="post" id="sobre_mimForm" name="sobre_mimForm">
                <?php                    
                $query="SELECT user_id FROM users WHERE nome_user='$user'";
                $user_id = 0;
                if($stmt = @mysqli_query($dbc, $query)) {
                    $row2 = mysqli_fetch_array($stmt);
                    if($row2['user_id'] !='') {
                        $user_id = $row2['user_id'];
                    }
                }           
                echo "<input type='hidden' id='id_userForm' name='id_userForm' value='$user_id' />";
                ?>
                    <div class="row">
                        <div class="col-lg-2 labels">
                            <p>Primeiro Nome</p>
                        </div>
                        <div class="col-lg-10 information"> 
                            <input type="text" name="primeiro_nomeForm" id="primeiro_nomeForm" placeholder="Primeiro Nome"/>
                        </div>
                    </div>

                    <div class="row"> 
                        <div class="col-lg-2 labels">
                            <p>Ultimo Nome</p>
                        </div>
                        <div class="col-lg-10 information">
                            <input type="text" name="ultimo_nomeForm" id="ultimo_nomeForm" placeholder="Ultimo Nome"/>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-2 labels">
                            <p>Email</p>
                        </div>
                        <div class="col-lg-10 information">
                            <input type="text" name="emailForm" id="emailForm" placeholder="Email"/>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-2 labels">
                            <p>Sobre Mim</p>
                        </div>
                        <div class="col-lg-10">
                            <textarea id="textareaForm" name="textareaForm"></textarea>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-2 labels">
                            <p>Letra</p>
                        </div>
                        <div class="col-lg-10 information">
                            <div class="col-lg-1" id="letraDiv">
                                <?php
                                    $letra = $row['letra']; 
                                    $query = "SELECT letra from letras";
                                    if($stmt = @mysqli_query($dbc, $query)) {
                                        while($letras = mysqli_fetch_array($stmt)){
                                            $letraBD = $letras['letra'];
                                            if($letraBD != $letra){
                                                echo "<h1 class='letrasSquare'>$letraBD</h1>";
                                            }        
                                            else {
                                                echo "<h1 class='letrasSquare letraSelected'>$letra</h1>";
                                            }
                                        }
                                    }
                                        
                                ?>
                            </div>
                            <input type="hidden" name="letraForm" id="letraForm"  value="<?php echo $letra ?>"/>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-2 labels">
                            <p>Cor</p>
                        </div>
                        <div class="col-lg-10 information">
                            <div class="col-lg-1" id="corDiv">
                                <?php
                                    $corEscolhida = $row['valor_hex']; 
                                    $query = "SELECT valor_hex from cores";
                                    if($stmt = @mysqli_query($dbc, $query)) {
                                        while($cores = mysqli_fetch_array($stmt)){
                                            $cor = $cores['valor_hex'];
                                            if($corEscolhida != $cor){
                                                echo "<div class='selecionarCor corHover' style='background-color:$cor'></div>";
                                            }
                                            else {
                                                echo "<div class='selecionarCor corSelected' style='background-color:$corEscolhida'></div>";
                                            }        
                                        }
                                    }
                                        
                                ?>

                            </div>
                            <input type="hidden" name="corForm" id="corForm" value="<?php echo $corEscolhida?>"/>
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-lg-8 col-lg-offset-4">
                            <input type="submit" name="submitSobre_mimForm" id="submitSobre_mimForm" value="Gravar"/>
                            <input type="button" value="Cancelar Alteracoes" id="cancelarInformacoesBt" onclick="showAlterarInformacoes();"/>
                        </div>
                        <div class="col-lg-2">
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="col-lg-12" id="alterarInformacoesDiv" >
                <input type="button" value="Alterar Informacoes" id="alterarInformacoesBt" onclick="showSobre_mimForm();"/>
            </div>
        </div>
    </div>

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

    <script type="text/javascript">
        
        function showSobre_mimForm() {
            var formSobreMim = document.getElementById('sobre_mimForm');
            var alterarInformacoesDiv = document.getElementById('alterarInformacoesDiv');
            var informacoesSobre_mim = document.getElementById('informacoesSobre_mim');
            formSobreMim.style.display = "block";
            alterarInformacoesDiv.style.display = "none";
            informacoesSobre_mim.style.display = "none";
            

        } 

        function showAlterarInformacoes() {
            var formSobreMim = document.getElementById('sobre_mimForm');
            var alterarInformacoesDiv = document.getElementById('alterarInformacoesDiv');
            var informacoesSobre_mim = document.getElementById('informacoesSobre_mim');
            formSobreMim.style.display = "none";
            alterarInformacoesDiv.style.display = "block";           
            informacoesSobre_mim.style.display = "block";
        }
    
        var primeiro_nome = "<?php echo $row['primeiro_nome'];?>";
        var ultimo_nome = "<?php echo $row['ultimo_nome'];?>";
        var email = "<?php echo $row['email'];?>";
        var sobre_mim = `<?php echo $row["sobre_mim"];?>`;
        var  letra = '<?php echo $row["letra"];?>';
        var valor_hex = "<?php echo $row['valor_hex'];?>";

        var input_primeiroNome = document.getElementById('primeiro_nomeForm');
        var input_ultimoNome = document.getElementById('ultimo_nomeForm');
        var input_email = document.getElementById('emailForm');
        var input_sobreMim = document.getElementById('textareaForm');

        input_primeiroNome.value = primeiro_nome;
        input_ultimoNome.value = ultimo_nome;
        input_email.value = email;
        $('#textareaForm').html(sobre_mim);
    
        tinymce.init({
            selector: 'textarea',
            height: 300,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code'

            ],
            toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            content_css: '//www.tinymce.com/css/codepen.min.css',
            block_formats: 'Paragraph=p;Header 1=h1;Header 2=h2;Header 3=h3'
        });

        $('.letraSelected').css("backgroundColor", $('.corSelected').css( "backgroundColor" ));

        $('.letraSelected').css("color", "#fff");

        var hexDigits = new Array
            ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"); 

        //Function to convert rgb color to hex format
        function rgb2hex(rgb) {
            rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
            return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
        }

        function hex(x) {
            return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
        }



    
        $('#letraDiv').on("click", ".letrasSquare", function(){ 
            $('.letraSelected').css("backgroundColor", "buttonface");
            $('.letraSelected').css("color", "#000");

            var elems = document.querySelectorAll(".letrasSquare");

            [].forEach.call(elems, function(el) {
                el.classList.remove("letraSelected");
            });
            this.className += " letraSelected";
        
        
            $('.letraSelected').css("backgroundColor", $('.corSelected').css( "backgroundColor" ));

            $('.letraSelected').css("color", "#fff");

            var input_letra = document.getElementById('letraForm');
            input_letra.value = this.innerHTML; 
    
        });

    
        $('#corDiv').on("click", ".selecionarCor", function(){

            var elems = document.querySelectorAll(".selecionarCor");

            [].forEach.call(elems, function(el) {
                el.classList.remove("corSelected");
            });
            this.className += " corSelected";

            $('.letraSelected').css("backgroundColor", $('.corSelected').css( "backgroundColor" ));

            $('.letraSelected').css("color", "#fff");

            var input_cor = document.getElementById('corForm');
            input_cor.value = rgb2hex(this.style.backgroundColor); 

        }); 



    </script>

</body>
</html>
