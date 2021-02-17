<?php
header('Content-Type: text/html; charset=utf-8');
require 'conexao.php';
if (isset($_POST["op"])){
	$operacao=$_POST["op"];
}
$conexao=new conexao_banco();
$conexao->conectar();
switch ($operacao){
	case "verificarplaca":
		try{
			$stm=$conexao->conectar()->prepare("select placa from veiculo_visitante where placa=:placa");
			$stm->bindParam(":placa",$_POST["placa"]);
			$stm->execute();
			if ($stm->rowCount()==1){
				echo "Existe";
			}else{
				echo "Nao_Existe";
			}
		}catch (Exception $e){
			echo "Erro ao acessar a base de dados";
		}
		break;
	case "cadastrar":
		try{
			$descricao=strtoupper($_POST["descricao"]);
			$placa=strtoupper($_POST["placa"]);
			$stm=$conexao->conectar()->prepare("insert into veiculo_visitante values(:placa,:descricao,:cpf)");
			$stm->bindParam(":descricao",$descricao);
			$stm->bindParam(":placa",$placa);
			$stm->bindParam(":cpf",$_POST["cpf"]);
			$stm->execute();
			echo "Cadastro de veiculo realizado com sucesso!";
		}catch (Exception $e){
			echo "Erro ao acessar a base de dados";
		}
		break;
		
}