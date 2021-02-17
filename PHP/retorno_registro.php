<?php
require_once 'conexao.php';
if (isset ( $_POST ['op'] )) {
	$operacao = $_POST ['op'];
}
switch ($operacao) {
	case "criar_selecionado":
		session_name("scv");
        session_start();
		$_SESSION['registro']=$_POST["id"];
		echo "criado";
		break;
	case "retornar_registro":
		try {
			header ( "Content-Type: application/json; charset=utf-8" );
			session_name("scv");
            session_start();
			$conexao = new conexao_banco();
			$conexao->conectar();
			$stmt=$conexao->conectar()->prepare("select * from registro_acesso_view where id=:id");
			$stmt->bindParam(":id",$_SESSION['registro']);
			$stmt->execute();
			$linha = $stmt->fetch ( PDO::FETCH_OBJ ) ;
            $resposta= array(
				"cpf"=>$linha->cpf,
				"nome"=>$linha->nome,
				"foto"=>$linha->foto,
				"empresa"=>$linha->empresa,
				"setor"=>$linha->setor,
				"contato"=>$linha->contato,
				/*"veiculo"=>$linha->veiculo,*/
				"entrada"=>$linha->entrada,
				"saida"=>$linha->saida
			);
            echo json_encode($resposta);
		} catch (Exception $e) {
		}
		break;	
	
	case "retornar_imagem" :
		try {
			$conexao = new conexao_banco ();
			$conexao->conectar ();
			$stmt = $conexao->conectar ()->prepare ( "select foto from visitante where cpf=:cpf" );
			$stmt->bindParam ( ":cpf", $_POST ["cpf"] );
			$stmt->execute ();
			$linha = $stmt->fetch ( PDO::FETCH_OBJ );
			echo "<img class=foto_visitante src='" . ($linha->foto) . "'>";
		} catch ( Exception $e ) {
			echo "Erro ao acessar a base de dados";
		}
		break;
	case "registrar_retorno":
		try {
            //Verificação se o km de retorno é maior do que a de saida
            $conexao=  new conexao_banco();
			$conexao->conectar();
            $stmt= $conexao->conectar()->prepare('select km_saida from registro_viaturas where id_registro=:id');
            $stmt->bindParam("id", $_POST['id']);
            $stmt->execute();
            $linha=$stmt->fetch(PDO::FETCH_OBJ);
            $km=(int)$linha->km_saida;
            if (($km)>=((int)$_POST['km'])){
                echo "erro";        
            }else{
                // bloco de alteração da tabela de registro de retorno de viaturas
			    $stmt= $conexao->conectar()->prepare('update registro_viaturas set data_retorno=current_date(), hora_retorno="'.$_POST['hora'].'",km_retorno=:km where id_registro=:id');
			     //$stmt->bindParam("hora", $_POST['hora']);
			     $stmt->bindParam("km", $_POST['km'],PDO::PARAM_INT);
			     $stmt->bindParam("id", $_POST['id']);
			     $stmt->execute();
			     //----------------------
			     //seleção do registro alterado anteriormente para captar a viatura e o motorista utilizados
			     $stmt= $conexao->conectar()->prepare("select viatura,motorista from registro_viaturas where id_registro=:id");
			     $stmt->bindParam("id", $_POST['id']);
			     $stmt->execute();
			     $linha=$stmt->fetch(PDO::FETCH_OBJ);
			     //bloco de alteração de viatura, deixando-a disponivel novamente
			     $stmt= $conexao->conectar()->prepare('update viatura set ativo=0 where placa="'.$linha->viatura.'"');
			     $stmt->execute();
			     //bloco de alteraçãp de motorista, deixando-o disponivel novamente
			     $stmt= $conexao->conectar()->prepare("update motorista set ativo=0 where matricula=".$linha->motorista);
			     $stmt->execute();
			     //bloco de retorno da tabela
			     /*$stmt=$conexao->conectar()->prepare("select * from registro_viaturas");
			     $stmt->execute();
			     while ( $linha = $stmt->fetch ( PDO::FETCH_OBJ ) ) {
				    echo "<tr id=" . $linha->id_registro . ">";
				    echo "<td class=motorista>" . $linha->motorista . "</td>";
				    echo "<td class=viatura>" . $linha->viatura . "</td>";
				    echo "<td class=destino>" . $linha->destino . "</td>";
				    echo "<td class=data>" . $linha->data_saida. "</td>";
				    echo "</tr>";
			     }*/
                echo "ok";
            }
		} catch (Exception $e) {
			echo "Erro ao acessar a base de dados";
		}
		break;
};