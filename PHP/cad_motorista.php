<?php
	require_once 'conexao.php';
	if (isset($_POST['op'])){
		$operacao=$_POST['op'];
	}
	$conexao=new conexao_banco();
	$conexao->conectar();
	switch ($operacao){
		case "verificar":
			try {
				//header("Content-Type: application/json; charset=utf-8" );
				$stmt=$conexao->conectar()->prepare("select count(*) as contagem from motorista where matricula=:mat");
				$stmt->bindParam("mat",$_POST['mat'],PDO::PARAM_INT);
				$stmt->execute();
				$linhas=$stmt->fetch(PDO::FETCH_OBJ);
				if (($linhas->contagem)==0){
					echo "true";			
				} else {
					echo "false";
				}
			} catch (Exception $e) {
				echo "Erro ao acessar a base de dados";
			}
			break;
		case "cadastrar":
			try {
				$nome= strtoupper($_POST["nome"]);
				$stmt=$conexao->conectar()->prepare("insert into motorista values (:matricula,:nome,0)");
				$stmt->bindParam("matricula", $_POST['matricula']);
				$stmt->bindParam("nome", $nome);
				$stmt->execute();
				echo "Cadastro realizado com sucesso";				
			} catch (Exception $e) {
				echo "Erro ao acessar a base de dados";
			}
	}