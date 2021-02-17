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
			$stm=$conexao->conectar()->prepare("select placa from visitante where placa=:placa");
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
			$stm=$conexao->conectar()->prepare("insert into viatura values(null,upper(:descricao),upper(:placa))");
			$stm->bindParam(":descricao",$_POST["descricao"]);
			$stm->bindParam(":placa",$_POST["placa"]);
			$stm->execute();
			echo "Cadastro realizado com sucesso!";
		}catch (Exception $e){
			echo "Erro ao acessar a base de dados";
		}
		break;
		
}