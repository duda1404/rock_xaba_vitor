
<?php
include 'header.php'

?>

<?php

//Conexão
//The require_once expression is identical to require except PHP will check if the file has already been included, and if so, not include (require) it again.
require_once 'config.php';

//iniciar a sessão
session_start();

//Inicialização da variável erro
$erroLoginSenha = "";

//se existir o indice btn_entrar , é porque alguém clicou no botão

if (isset($_POST['btn-entrar'])):

	//mysqli_escape_string - função que limpa os dados e evita sqlinjection e outros caracteres indevidos.
	$login = mysqli_escape_string($connect, $_POST['login']);
	$senha = mysqli_escape_string($connect, $_POST['senha']);
	
	
	if(empty($login) or empty($senha)):

		$erroLoginSenha = "Os campos precisam ser preenchidos";

	else:
		//criptografando a senha
	
		$resultado = mysqli_query($connect,"SELECT id_user FROM usuario WHERE nome_user= '$login' AND senha_user='$senha' ");
		//fechando a conexão depois de armazenar os dados
		mysqli_close($connect);
		
		//numeros de linhas do resultado da query maior que 0 ou Se houver algum registro na tabela
		if (mysqli_num_rows($resultado) > 0):
			$dados=mysqli_fetch_array($resultado);
			$_SESSION['logado']= true;
			$_SESSION['id_user']= $dados['id_user'];
			//comando que redireciona para página index_logado.php - deve criar essa página
			header('Location: index_logado.php');		
		
		else:
			$erroLoginSenha ="Seu login ou senha podem estar errados";
			
		endif;
		
	endif;	
endif;	
?>

<section class="login">

<form class="caixa" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

	<input type="text" name="login" placeholder="Usuário"><br>
 	<input type="password" name='senha' placeholder="Senha">
 	<button type="submit" name="btn-entrar">Entrar</button>
 	<span class="erro"><?php echo $erroLoginSenha; ?></span>

 	<a href="cadastro.php">
    	<input type="button" name="cadastro" value="Criar conta">
 	</a>

</form>

</body>
</html>

