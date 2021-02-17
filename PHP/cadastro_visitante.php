<?php
/*header('Content-Type: text/html; charset=utf-8');*/
require 'conexao.php';
if (isset($_POST["op"])){
	$operacao=$_POST["op"];
}
switch ($operacao){
	case "verificarCPF":
		try{
			$conexao=new conexao_banco();
			$conexao->conectar();
			$stm=$conexao->conectar()->prepare("select cpf from visitante where cpf=:cpf");
			$stm->bindParam(":cpf",$_POST["cpf"]);
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
	case "verificarRG":
		try{
			$conexao=new conexao_banco();
			$conexao->conectar();
			$stm=$conexao->conectar()->prepare("select rg from visitante where cpf=:cpf");
			$stm->bindParam(":rg",$_POST["rg"]);
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
	case "listarsetor":
		try{
			$conexao=new conexao_banco();
			$conexao->conectar();
			$stm=$conexao->conectar()->prepare("select * from setor order by descricao");
			$stm->execute();
			echo '<option value=""> </option>';
			while ($linha=$stm->fetch(PDO::FETCH_OBJ)){
				echo '<option value="'.$linha->idsetor.'">'.$linha->descricao.'</option>';
			}
		}catch (Exception $e){
			echo "Erro ao acessar a base de dados";
		}
		break;
	case "listarcracha":
		try{
			$conexao=new conexao_banco();
			$conexao->conectar();
			$stm=$conexao->conectar()->prepare("select * from cracha where status=0 order by numero");
			$stm->execute();
			echo '<option value=""> </option>';
			while ($linha=$stm->fetch(PDO::FETCH_OBJ)){
				echo '<option value="'.$linha->numero.'">'.$linha->numero.'</option>';
			}
		}catch (Exception $e){
			echo "Erro ao acessar a base de dados";
		}
		break;
	case "cadastro":
		$nome= strtoupper($_POST["nome"]);
		$empresa=strtoupper($_POST["empresa"]);		
		if (isset($_POST["foto"])){
			try {
				$conexao= new conexao_banco();
				$conexao->conectar();
				$stmt=$conexao->conectar()->prepare("insert into visitante values(:cpf,:rg,null,:nome,:empresa,:foto,null,null,null)");
				$stmt->bindParam("cpf", $_POST["cpf"]);
				$stmt->bindParam("rg", $_POST["rg"]);
				$stmt->bindParam("nome", $nome);
				$stmt->bindParam("empresa", $empresa);
				$stmt->bindParam("foto", $_POST["foto"]);
				$stmt->execute();
				echo "Visitante Cadastrado";
			} catch (Exception $e) {
				echo "Erro ao acessar a base de dados";
			}	
		}else{
			try {
				$conexao= new conexao_banco();
				$conexao->conectar();
				$stmt=$conexao->conectar()->prepare("insert into visitante values(:cpf,:rg,null,:nome,:empresa,null,null,null,null)");/*:foto*/
				$stmt->bindParam("cpf", $_POST["cpf"]);
				$stmt->bindParam("rg", $_POST["rg"]);
				$stmt->bindParam("nome", $nome);
				$stmt->bindParam("empresa", $empresa);
				/*$stmt->bindParam("foto", $_POST["foto"]);*/
				$stmt->execute();
				echo "Visitante Cadastrado";
			} catch (Exception $e) {
				echo "Erro ao acessar a base de dados";
			}
		}
		
		break;
}