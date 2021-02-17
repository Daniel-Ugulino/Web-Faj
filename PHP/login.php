<?php
	header('Content-Type: text/html; charset=utf-8');	
	require 'conexao.php';
	if (isset($_POST["op"])){
		$operacao=$_POST["op"];
	}
	switch ($operacao){
		case "logout":
			session_name("scv");
			session_start();
			session_destroy ();
			$resposta = true;
			echo json_encode ( $resposta );
			;
			break;
		case "login":
			try{
				$conexao=new conexao_banco();
		$conexao->conectar();
		$stmt=$conexao->conectar()->prepare('select * from usuarios where login=:login');
		$stmt->bindParam(':login',$_POST['login'],PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt->rowCount()==1){
			$stmt=$conexao->conectar()->prepare('select * from usuarios where login=:login and senha=md5(:senha) ');
			$stmt->bindParam(':login',$_POST['login'],PDO::PARAM_STR);
			$stmt->bindParam(':senha',$_POST['senha'],PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount()==1){
					session_name("scv");
					session_set_cookie_params(0,"/scv/","localhost",false,false);
					session_start();
					foreach ($stmt as $linha){
						$_SESSION['id']=$linha['idusuarios'];
						$_SESSION['login']=$linha['login'];
						$_SESSION['nome']=$linha['nome'];
					}
					echo "session";
					}else{
				echo 'senha';
				}
				
			}else {
				echo 'login';
				;
			}
			}catch (Exception $e){
				echo "Erro ao acessar a base de dados";
			}
			break;
	}
	
	/*
	function login($login,$senha) {
		$conexao=new conexao_banco();
		$conexao->conectar();
		$stmt=$conexao->conectar()->prepare('select * from usuarios where login=:login and ativo=1');
		$stmt->bindParam(':login',$login,PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt->rowCount()==1){
			$stmt=$conexao->conectar()->prepare('select * from usuarios where login=:login and senha=md5(:senha) and ativo=1');
			$stmt->bindParam(':login',$login,PDO::PARAM_STR);
			$stmt->bindParam(':senha',$senha,PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount()==1){
				session_name("sisben");
				session_set_cookie_params(0,"/sisben/","localhost",false,false);
				session_start();
				foreach ($stmt as $linha){
					$_SESSION['id']=$linha['id_usuarios'];
					$_SESSION['login']=$linha['login'];
					$_SESSION['perfil']=$linha['perfil'];
					$_SESSION['tipo']=$linha['tipo'];
					$_SESSION['nome']=$linha['nome'];
				}
				return 'session';
			}else{
				return 'senha';
			}
				
		}else {
			return 'login';
			;
		}
		;
	}*/