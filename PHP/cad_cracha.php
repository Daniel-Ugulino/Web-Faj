<?php
	require_once 'conexao.php';
	if (isset($_POST['op'])){
		$operacao=$_POST['op'];
	}
	$conexao=new conexao_banco();
	$conexao->conectar();
	switch ($operacao){
		case 'verificar':
			try {
				$stmt=$conexao->conectar()->prepare("select count(*) contagem from cracha where numero=:numero");
				$stmt->bindParam("numero", $_POST['cracha']);
				$stmt->execute();
				$linhas=$stmt->fetch(PDO::FETCH_OBJ);
				if (($linhas->contagem)==0){
					echo "true";
				} else {
					echo "false";
				}
			} catch (Exception $e) {
				echo 'erro ao acessar a base de dados';
			}
			;
			break;
		case 'cadastrar':
			try {
				$stmt=$conexao->conectar()->prepare("insert into cracha values (:numero,0)");
				$stmt->bindParam("numero", $_POST['cracha']);
				$stmt->execute();
			} catch (Exception $e) {
				echo 'erro ao acessar a base de dados';
			}
			;
			break;
	}