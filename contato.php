<?php
include 'header.php';

/* Validação do formulário */  

/* Inicialização de variáveis utilizadas na validação */

$erroEmail = "";
$erroNome = "";
$erroMensagem = "";

  if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    /* VALIDA CAMPO USUÁRIO */

    /* Verifica se o campo de usuário está vazio assim que o botão de Enviar formulário (submit) é pressionado, se sim, emite uma mensagem pedindo seu preenchimento */  
    if(empty($_POST['nome'])){

      $erroNome = "Por favor, preencha o nome de usuário";

  }
  
  else{

      /* Recebe uma variável nome que é preenchida com o que foi escrito no campo de usuário e chama a função limpaPost*/

      $nome = limpaPost($_POST['nome']);

      /* Verifica se o que foi digitado é um texto válido ou não */
      /* Preg_match - Verifica o que foi inserido na String (nome) e, caso alguma condição seja acionada (! - caso seja falsa), retorna true ou false*/
      /* Aceita letras minúsculas, maísculas de A até Z, apóstrofe e espaços */

      if(!preg_match("/^[a-zA-Z-' ]*$/", $nome)){

        $erroNome = "Apenas aceitamos letras e espaços em branco!";

      }

  }

    /* VALIDA CAMPO EMAIL */

    /* Verifica se o campo de email está vazio assim que o botão de Enviar formulário (submit) é pressionado, se sim, emite uma mensagem pedindo seu preenchimento */  
    if(empty($_POST['email'])){

        $erroEmail = "Por favor, informe um email";

    }
    
    else{

        /* Inicializa uma variável email que é preenchida com o que foi escrito no campo de email e chama a função limpaPost*/

        $email = limpaPost($_POST['email']);

        /* Verifica se o que foi digitado é um email válido ou não. Caso seja diferente de válido, coloca uma mensagem de erro dentro da variável $erroEmail */
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

          $erroEmail = "Email inválido!";

        }

    }

    /* VALIDA CAMPO MENSAGEM */

    if(empty($_POST['mensagem'])){

      $erroMensagem = "Por favor, digite sua mensagem";

  }
  
  else{

      /* Inicializa uma variável mensagem que é preenchida com o que foi escrito no campo de mensagem e chama a função limpaPost*/

      $mensagem = limpaPost($_POST['mensagem']);

      /* Verifica se o que foi digitado é um texto válido ou não */
      /* Preg_match - Verifica o que foi inserido na String (mensagem) e, caso alguma condição seja acionada (! - caso seja falsa), retorna true ou false*/
      /* Aceita letras minúsculas, maísculas de A até Z, apóstrofe e espaços */

      if(!preg_match("/^[a-zA-Z-' ]*$/", $mensagem)){

        $erroMensagem = "Apenas aceitamos letras e espaços em branco!";

      }

  }
    

    /* Emite um alerta em JavaScript caso o formulário seja preenchido e enviado sem erros, informando ao usuário seu envio */

    if(($erroNome == "") && ($erroEmail == "") && ($erroMensagem == "")) {

        echo"<script>alert('Mensagem Enviada!')</script>";
    } }

/* FUNÇÃO QUE IMPEDE A INSERÇÃO DE CÓDIGOS MALICIOSOS NO FORMULÁRIO */

  /* Função que limpa o post (informação digitada pelo usuário) impedindo a inserção de códigos maliciosos no formulário*/

  function limpaPost($valor){
    
    /* valor - variável qualquer digitada nos campos pelo usuário */
    /* Tira os espaços em branco no início e no final de valor*/
    $valor = trim($valor);
     /* Tira as barras de valor*/
    $valor = stripslashes($valor);
     /* Tira caracteres especiais de html de valor*/
     $valor = filter_var($valor, FILTER_SANITIZE_SPECIAL_CHARS);
    return $valor;
}

?>

<section class="contato">
 <!--Seção do contato, contendo o formulário a ser preenchido -->
  
  <form class="formulario" method="POST">

    <h1> Contato </h1>

    <!-- php echo, no span, emite as mensagens de erro (caso ocorram) embaixo de cada campo -->
    <!-- php do if(isset) estabelece a condição de caso o POST existir (isset) o valor do input será novamente preenchido com as informações antes digitadas pelo usuário  -->
    <!-- php if(!empty) estabelece a condição de caso as variáveis de erro não sejam vazias (e, portanto, haja erros nos campos digitados pelo usuário), será criada uma classe invalido, 
    referente ao input, permitindo que a sombra do elemento fique vermelha -->

      <input type="text" name="nome" <?php if(!empty($erroNome)){echo "class='invalido'";}?> <?php if(isset($_POST['nome'])){echo "value='".$_POST['nome']."'";} ?> placeholder="Usuário" required>
      <span class="erro"><?php echo $erroNome; ?></span>

      <input type="email" name="email" <?php if(!empty($erroEmail)){echo "class='invalido'";}?> <?php if(isset($_POST['email'])){echo "value='".$_POST['email']."'";} ?> placeholder="Email" required>
      <span class="erro"><?php echo $erroEmail; ?></span>

      <input type="text" name="mensagem" <?php if(!empty($erroMensagem)){echo "class='invalido'";}?> <?php if(isset($_POST['mensagem'])){echo "value='".$_POST['mensagem']."'";} ?> placeholder="Mensagem" required>
      <span class="erro"><?php echo $erroMensagem; ?></span>

      <button type="submit"> Enviar</button>

</form>
</body>
</section>
</html>
