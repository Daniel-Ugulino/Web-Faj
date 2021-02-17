<?php
require 'conexao.php';
if (isset($_POST["op"])){
	$operacao=$_POST["op"];
}
$conexao=new conexao_banco();
$conexao->conectar();
switch ($operacao){
	case "verificar":
		try{
			$stm=$conexao->conectar()->prepare("select upper(descricao) from setor where descricao like upper(:descricao)");
			$stm->bindParam(":descricao",($_POST["descricao"]));
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
		case "cadastro":
			try{
				$stm=$conexao->conectar()->prepare("insert into setor values(null,upper(:descricao))");
				$stm->bindParam(":descricao",($_POST["descricao"]));
				$stm->execute();
				echo "Cadastrado com sucesso";
			}catch (Exception $e){
				echo "Erro ao acessar a base de dados";
			}
			break;
}