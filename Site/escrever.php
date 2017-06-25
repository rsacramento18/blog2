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
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'escrever' });</script>
<script src="https://code.jquery.com/jquery-3.0.0.js"></script>
</head>
 
<body>
<?php
    if(isset($_SESSION['user'])) {
        $user = $_SESSION['user']; 
        $query="SELECT user_id FROM users WHERE nome_user='$user'";
        $user_id = 0;
        if($stmt = @mysqli_query($dbc, $query)) {
            $row = mysqli_fetch_array($stmt);
            if($row['user_id'] !='') $user_id = $row['user_id'];
        }
        $query = "SELECT id_escritor FROM escritores WHERE id_user=$user_id";
        
        if($stmt = @mysqli_query($dbc, $query)) {
            $resultadoQuery = $stmt->num_rows;
            if($stmt->num_rows == 0 ) {
?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3">
                        <h1 class="postTittle">Login Primeira Vez</h1>
                    </div>
                    <div class="col-lg-6 col-lg-offset-4">
                        <p class='post'>Introduzir todos os dados antes de proseguir</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form action="sobre_mimInsert.php" method="post" id="sobre_mimForm" name="sobre_mimForm">
<?php                    
                            $query="SELECT user_id FROM users WHERE nome_user='$user'";
                            $user_id = 0;
                            if($stmt = @mysqli_query($dbc, $query)) {
                                $row2 = mysqli_fetch_array($stmt);
                                if($row2['user_id'] !='') {
                                    $user_id = $row2['user_id'];
                                }
                            }           
                            echo "<input type='hidden' id='id_userForm' name='id_userForm' value=$user_id/>";
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
                                            $query = "SELECT letra from letras";
                                            if($stmt = @mysqli_query($dbc, $query)) {
                                                while($letras = mysqli_fetch_array($stmt)){
                                                    $letraBD = $letras['letra'];
                                                    echo "<h1 class='letrasSquare'>$letraBD</h1>";
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
                                            $query = "SELECT valor_hex from cores";
                                            if($stmt = @mysqli_query($dbc, $query)) {
                                                while($cores = mysqli_fetch_array($stmt)){
                                                    $cor = $cores['valor_hex'];
                                                    echo "<div class='selecionarCor corHover' style='background-color:$cor'></div>";
     
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
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


<?php
            
            }
            else {

?>
    <div class="container" id="header">
        <div class="row">
           <div class="col-lg-12"> 
            
                <div id="nav2">
                    <ul class="list-inline">
                        <li><a href="index.php">BLOG</a></li>
                        <li><a href="escrever.php" class="selected">ESCREVER</a></li>
                        <li><a href="os_meus_posts.php">OS MEUS POSTS</a></li>
                        <li><a href="sobre_mim.php">SOBRE MIM</a></li>
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
            <div class="col-lg-12  post">
                <form action="escreverPost.php" method="post" id="formEscrever" name="formEscrever"/>
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
                            <p>Titulo</p>
                        </div>
                        <div class="col-lg-10 information">
                            <input type="text" id="tituloForm" name="tituloForm" placeholder="Tituto"/>
                        </div>
                    </div>    

                    <div class="row">
                        <div class="col-lg-2 labels">
                            <p>Subtitulo</p>
                        </div>
                        <div class="col-lg-10 information">
                            <input type="text" name="subtituloForm" id="subtituloForm" placeholder="Subtitulo"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 labels">
                            <p>Post</p>
                        </div>
                        <div class="col-lg-10 information">
                            <textarea id="escrever" name = "escrever"></textarea>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-7 col-lg-offset-5">
                            <input type="submit" name="escreverSubmit" id="escreverSubmit" value="Publicar"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <?php
            }
        }
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
        tinymce.init({
                selector: 'textarea',
                height: 400,
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
        var resultado = "<?php echo $resultadoQuery;?>";  
        if(resultado == 0){
            document.getElementById('sobre_mimForm').style.display = "block";
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
