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
    <div class="container" id="header">
        <div class="row">
            <div class="col-lg-12">
            <?php
                if(isset($_SESSION['user'])) {

            ?>
                <div id="nav2">
                    <ul class="list-inline">
                        <li><a href="index.php" class="selected">BLOG</a></li>
                        <li><a href="escrever.php">ESCREVER</a></li>
                        <li><a href="os_meus_posts.php">OS MEUS POSTS</a></li>
                        <li><a href="sobre_mim.php">SOBRE MIM</a></li>
                        <?if($_SESSION['user']=='ricardo'):?>
                        <li><a href="administracao.php">ADMINISTRACAO</a></li>
                        <?php endif;?>
                        <li><a href="sair.php">SAIR</a></li>
                    </ul>
                </div>
            <?php
                }
                else {
            
            ?>
                <div id="nav">
                    <ul class="list-inline">
                        <li><a href="index.php" class="selected">BLOG</a></li>
                        <li><a href="#">SOBRE NOS</a></li>
                        <li><a href="#">CONTACTOS</a></li>
                        <li><a href="#"  onclick="apresentarAreaEscritorForm();">AREA DE ESCRITOR</a></li>
                        <li><a href="#">PUBLICACOES ANTIGAS</a></li>
                    </ul>
                </div>
            </div>
            
            <?php 
                }
            ?>

            <div id="logo"  class="col-lg-4 col-lg-offset-4">
                <div id="text-logo" class="text-center">
                    <h1>de A a Z</h1>
                </div>
                
                
            </div>
        </div>
    </div>
<?php
    $query = "SELECT post.titulo, post.sub_titulo, post.artigo, date_format(post.data, '%d/%m/%Y') data, letras.letra, cores.valor_hex 
FROM post INNER JOIN escritores ON post.id_user=escritores.id_user 
INNER JOIN letras ON escritores.letra_id=letras.letra_id 
INNER JOIN cores ON escritores.cor_id=cores.cor_id GROUP BY post.data DESC";

    
    if($stmt = @mysqli_query($dbc, $query)) {
        echo "<div class='container'>";
            echo "<div class='row'>";
        while($row = @mysqli_fetch_array($stmt)){
                    echo "<div class='col-lg-12 post'>";
                        echo "<div class='letraAutor' style='background-color:".$row['valor_hex']."'>";
                            echo "<div class='letra'>".$row['letra']."</div>";
                        echo "</div>";
                        echo "<h1 class='postTittle'>".$row['titulo']."</h1>";
                        echo "<h2 class='postSubtittle'>".$row['sub_titulo']."</h2>";
                        echo "<div class='conteudoPost'>".$row['artigo']."</div>";
                        echo "<div class='assinatura'>";
                            echo "<p>Publicado a ".$row['data']." por ".$row['letra']."</p>";
                        echo "</div>";
                    echo "</div"; 
        }
            echo "</div>";
        echo "</div>";


    }


?>

    <div class="container">


        <div class="row">
           <div class="col-lg-12  post">
                <div class="letraAutor">
                    <div class="letra">M</div>
                </div>
                <h1 class="postTittle">Titulo Post</h1>
                <h2 class="postSubtittle">Subtitulo Post</h2>
                <div class="conteudoPost">
                    <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro. Este texto não só sobreviveu 5 séculos, mas também o salto para a tipografia electrónica, mantendo-se essencialmente inalterada. Foi popularizada nos anos 60 com a disponibilização das folhas de Letraset, que continham passagens com Lorem Ipsum, e mais recentemente com os programas de publicação como o Aldus PageMaker que incluem versões do Lorem Ipsum.</p>
                    <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro. Este texto não só sobreviveu 5 séculos, mas também o salto para a tipografia electrónica, mantendo-se essencialmente inalterada. Foi popularizada nos anos 60 com a disponibilização das folhas de Letraset, que continham passagens com Lorem Ipsum, e mais recentemente com os programas de publicação como o Aldus PageMaker que incluem versões do Lorem Ipsum.</p>
                </div>
                <div class="assinatura">
                    <p>Publicado a 12/04/2017 por Mr.M</p>
                </div>
            </div>

            <div class="col-lg-12  post">
                <div class="letraAutor letra2">
                    <div class="letra">R</div>
                </div>
                <h1 class="postTittle">Titulo Post</h1>
                <h2 class="postSubtittle">Subtitulo Post</h2>
                <div class="conteudoPost">
                    <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro. Este texto não só sobreviveu 5 séculos, mas também o salto para a tipografia electrónica, mantendo-se essencialmente inalterada. Foi popularizada nos anos 60 com a disponibilização das folhas de Letraset, que continham passagens com Lorem Ipsum, e mais recentemente com os programas de publicação como o Aldus PageMaker que incluem versões do Lorem Ipsum.</p>
                    <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro. Este texto não só sobreviveu 5 séculos, mas também o salto para a tipografia electrónica, mantendo-se essencialmente inalterada. Foi popularizada nos anos 60 com a disponibilização das folhas de Letraset, que continham passagens com Lorem Ipsum, e mais recentemente com os programas de publicação como o Aldus PageMaker que incluem versões do Lorem Ipsum.</p>
                    <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro. Este texto não só sobreviveu 5 séculos, mas também o salto para a tipografia electrónica, mantendo-se essencialmente inalterada. Foi popularizada nos anos 60 com a disponibilização das folhas de Letraset, que continham passagens com Lorem Ipsum, e mais recentemente com os programas de publicação como o Aldus PageMaker que incluem versões do Lorem Ipsum.</p>
                    <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro. Este texto não só sobreviveu 5 séculos, mas também o salto para a tipografia electrónica, mantendo-se essencialmente inalterada. Foi popularizada nos anos 60 com a disponibilização das folhas de Letraset, que continham passagens com Lorem Ipsum, e mais recentemente com os programas de publicação como o Aldus PageMaker que incluem versões do Lorem Ipsum.</p>
                </div>
                <div class="assinatura">
                    <p>Publicado a 12/04/2017 por Mr.M</p>
                </div>


            </div>
            <div class="col-lg-12  post">
                <div class="letraAutor letra3">
                    <div class="letra">C</div>
                </div>
                <h1 class="postTittle">Titulo Post</h1>
                <h2 class="postSubtittle">Subtitulo Post</h2>
                <div class="conteudoPost">
                    <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro. Este texto não só sobreviveu 5 séculos, mas também o salto para a tipografia electrónica, mantendo-se essencialmente inalterada. Foi popularizada nos anos 60 com a disponibilização das folhas de Letraset, que continham passagens com Lorem Ipsum, e mais recentemente com os programas de publicação como o Aldus PageMaker que incluem versões do Lorem Ipsum.</p>
                    <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro. Este texto não só sobreviveu 5 séculos, mas também o salto para a tipografia electrónica, mantendo-se essencialmente inalterada. Foi popularizada nos anos 60 com a disponibilização das folhas de Letraset, que continham passagens com Lorem Ipsum, e mais recentemente com os programas de publicação como o Aldus PageMaker que incluem versões do Lorem Ipsum.</p>
                </div>
                <div class="assinatura">
                    <p>Publicado a 12/04/2017 por Mr.M</p>
                </div>


            </div>
        </div>
    </div>

    
    <div id='areaEscritorForm' class='modal'>
        <div id='areaEscritorForm' class='modal-content'>
            <h2 class='modalTittle' >Entrar na Area de Escritor</h2> 
            <span id='closeAreaEscritorForm' class='close'>&times;</span>    
            
            <form action="login.php" name="formAreaEscritor" id="formAreaEscritor" method="post">
                <input type="text" size="20" name="user" id="user" placeholder="User"/></br>
                <input type="password" size="20" name="password" id="password" placeholder="Password"/>
                <input type="submit" value="Entrar" name="submitEscrever" id="subtmitEscrever"/>
            </form>
        </div>
    
    </div>

	<script type="text/javascript">
        
        var modal = document.getElementById('areaEscritorForm');  
        var closeAreaEscritorForm = document.getElementById("closeAreaEscritorForm");

        function apresentarAreaEscritorForm(){
            
            modal.style.display = "block";
        }

        closeAreaEscritorForm.onclick = function() {
            modal.style.display = "none";
        }


    </script>
    
</body>


</html>
