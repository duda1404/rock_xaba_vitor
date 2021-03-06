<?php
include 'header.php';

/* Verifica se o formulário foi enviado, se sim, salva as informações no Banco de Dados */

if (isset($_POST['btnentrar'])){

  /*
  echo "Email:" . $_POST['email'];
  echo "<br>";
  echo "Nome:" . $_POST['nome'] ;
  echo "<br>";
  echo "Senha:" . $_POST['senha'] ;
  echo "<br>";
  echo "Repete Senha:" . $_POST['repeteSenha'] ; 
*/

/* Inclui a conexão com o Banco de Dados*/

  include_once('config.php');

  $email =  $_POST['email'];
  $nome = $_POST['nome'];
  $senha = $_POST['senha'];

  $sql= "INSERT INTO usuario(email_user, nome_user, senha_user) VALUES ('" . $email . "','". $nome . "','" . $senha . "')";
  $resultado = mysqli_query($connect,$sql);
 /* echo $sql;*/
}


/* Validação do formulário */  

/* Inicialização de variáveis utilizadas na validação */

$erroEmail = "";
$erroNome = "";
$erroSenha = "";
$erroRepeteSenha = "";

  if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    /* VALIDA CAMPO EMAIL */

    /* Verifica se o campo de email está vazio assim que o botão de Enviar formulário (submit) é pressionado, se sim, preenche uma variável com uma mensagem pedindo seu preenchimento */  
    if(empty($_POST['email'])){

        $erroEmail = "Por favor, informe um email";

    }
    
    else{

        /* Recebe uma variável email que é preenchida com o que foi escrito no campo de email e chama a função limpaPost*/

        $email = limpaPost($_POST['email']);

        /* Verifica se o que foi digitado é um email válido ou não. Caso seja diferente de válido, coloca uma mensagem de erro dentro da variável $erroEmail */

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

          $erroEmail = "Email inválido!";

        }

    }

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

    /* VALIDA CAMPO SENHA */

    if(empty($_POST['senha'])){

      $erroSenha = "Por favor, preencha sua senha";

  }

    else{

          /* Recebe uma variável senha que é preenchida com o que foi escrito no campo de Senha e chama a função limpaPost*/

          $senha = limpaPost($_POST['senha']);

          /* Verifica se o que foi digitado é uma senha válida ou não */
          /* strlen - verifica o tamanho da variável (senha) digitada*/
          /* Caso a senha tenhos que 6 dígitos, emite uma mensagem de erro*/
          
          if(strlen($senha) < 6){

              $erroSenha = "A senha precisa ter, no mínimo, 6 dígitos";

    }

    /* VALIDA CAMPO REPETE SENHA */

    if(empty($_POST['repeteSenha'])){

        $erroRepeteSenha = "Por favor, preencha novamente sua senha";
  
    }
  
      else{
  
            /* Recebe uma variável repeteSenha que é preenchida com o que foi escrito no campo de repeteSenha e chama a função limpaPost*/
  
            $repeteSenha = limpaPost($_POST['repeteSenha']);
  
            /* Verifica se a senha digitada é igual à senha digitada no campo Senha, caso contrário, preenche a variável de erro com uma mensagem informando o problema*/
            
            if($repeteSenha != $senha){
  
                $erroRepeteSenha = "A senha está diferente da digitada anteriormente!";
  
      }

      /* Redireciona à página de Login se o cadastro é concluído sem erros*/

      if(($erroNome == "") && ($erroEmail == "") && ($erroSenha == "") && ($erroRepeteSenha == "")) {

          header('Location: login.php');
          
      }

        
    } 
  
  
}

}

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

<section class="cadastro">
<form class="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <h1> Cadastro </h1>

    <!-- php echo, no span, emite as mensagens de erro (caso ocorram) embaixo de cada campo -->
    <!-- php do if(isset) estabelece a condição de caso o POST existir (isset) o valor do input será novamente preenchido com as informações antes digitadas pelo usuário  -->
    <!-- php if(!empty) estabelece a condição de caso as variáveis de erro não sejam vazias (e, portanto, haja erros nos campos digitados pelo usuário), será criada uma classe inválido, 
    referente ao input, permitindo que a sombra do elemento fique vermelha -->


    <input type="email" name="email" <?php if(!empty($erroEmail)){echo "class='invalido'";}?> <?php if(isset($_POST['email'])){echo "value='".$_POST['email']."'";} ?> placeholder="Email" required>
    <span class="erro"><?php echo $erroEmail; ?></span>

    <input type="text" name="nome" <?php if(!empty($erroNome)){echo "class='invalido'";}?> <?php if(isset($_POST['nome'])){echo "value='".$_POST['nome']."'";} ?> placeholder="Usuário" required>
    <span class="erro"><?php echo $erroNome; ?></span>

    <p>(Minímo 6 dígitos, letras maiúsculas e minúsculas)</p>

    <input type="password" name="senha" <?php if(!empty($erroSenha)){echo "class='invalido'";}?> <?php if(isset($_POST['senha'])){echo "value='".$_POST['senha']."'";} ?> placeholder="Senha" required>
    <span class="erro"><?php echo $erroSenha; ?></span>

    <input type="password" name="repeteSenha" <?php if(!empty($erroRepeteSenha)){echo "class='invalido'";}?> <?php if(isset($_POST['repeteSenha'])){echo "value='".$_POST['repeteSenha']."'";} ?> placeholder="Repita a senha" required>
    <span class="erro"><?php echo $erroRepeteSenha; ?></span><br>

    <br><input type="checkbox" name="" id="op_email">
    <label for="op_email">Eu gostaria de receber notificações sobre datas de eventos em meu email</label>
    <button type="submit" name="btnentrar"> Concluir</button>

    <a href="login.php">
      <input type="button" name="voltar_login" value="Voltar">
    </a>

    </form>
  <section>
</body>


</html>