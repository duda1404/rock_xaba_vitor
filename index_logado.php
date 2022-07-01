<?php
include 'header.php'
?>

<?php

//Conexão
//The require_once expression is identical to require except PHP will check if the file has already been included, and if so, not include (require) it again.
/*Use require when the file is required by the application. Use include when the file is not required and application should continue when file is not found.*/
require_once 'config.php';

//iniciar a sessão
session_start();

//verificação para não permitir acessar a página home sem antes efetuar login
// se não existir a sessão logado
if (!isset($_SESSION['logado'])):
	header('Location: 17loginB.php');
endif;

//Dados
$id = $_SESSION['id_user'];


$resultado = mysqli_query($connect,"SELECT * FROM usuario WHERE id_user='$id'");
//transforma a variavel resultado em array 
$dados =mysqli_fetch_array($resultado);
//fechando a conexão depois de armazenar os dados
mysqli_close($connect);
?>


<title> <?php echo $dados['nome_user']; ?> </title>

   <!-- Seção do Slideshow, sendo cada slide uma classe, e cada classe contendo uma imagem-->
  <section class="principal">

  <div class="slideshow-container">
    <div class="mySlides fade">
      <img src="./img/1.jpg" style="width:100%">
    </div>

    <div class="mySlides fade">
      <img src="./img/2.jpg" style="width:100%">
    </div>

    <div class="mySlides fade">
      <img src="./img/3.jpg" style="width:100%">
    </div>

     <!--Botões de Anterior e Próximo -->
    <a class="prev" onclick="plusSlides(-1)">❮</a>
    <a class="next" onclick="plusSlides(1)">❯</a>

  </div>
 
   <!-- Indicadores da parte de baixo do Slideshow -->
  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
  </div>

  <script type="text/javascript" src="js/script.js"></script>

</body>
</html>


