<?php
require 'conexao.php';
if (isset($_POST['op'])){
	$operacao=$_POST['op'];
}
switch ($operacao){
	case "listar_viaturas":
		try{
			$conexao=new conexao_banco();
			$conexao->conectar();
			$stm=$conexao->conectar()->prepare("select * from viatura where ativo=0 order by descricao");
			$stm->execute();
			echo '<option value=""> </option>';
			while ($linha=$stm->fetch(PDO::FETCH_OBJ)){
				echo '<option value="'.$linha->placa.'">'.$linha->descricao.'</option>';
			}
		}catch (Exception $e){
			echo "Erro ao acessar a base de dados";
		}
		break;
	case "listar_motorista":
		try{
			$conexao=new conexao_banco();
			$conexao->conectar();
			$stm=$conexao->conectar()->prepare("select * from motorista where ativo=0 order by nome");
			$stm->execute();
			echo '<option value=""> </option>';
			while ($linha=$stm->fetch(PDO::FETCH_OBJ)){
				echo '<option value="'.$linha->matricula.'">'.$linha->nome.'</option>';
			}
		}catch (Exception $e){
			echo "Erro ao acessar a base de dados";
		}
		break;
		
	case "cadastrar":
		try {
			$conexao= new conexao_banco();
			$conexao->conectar();
			$stmt=$conexao->conectar()->prepare("insert into registro_viaturas values(null,:viatura,:motorista,upper(:material),upper(:destino),current_date(),null,current_time(),null,:km,null)");
			$stmt->bindParam("viatura", $_POST["viaturas"]);
			$stmt->bindParam("motorista", $_POST["motorista"]);
			$stmt->bindParam("material", $_POST["material"]);
			$stmt->bindParam("destino", $_POST["destino"]);
			$stmt->bindParam("km", $_POST["km"]);
			$stmt->execute();
			//echo "ok";
		} catch (Exception $e) {
			echo $e;
		}
		try {
			$conexao= new conexao_banco();
			$conexao->conectar();
			$stmt=$conexao->conectar()->prepare("update motorista set ativo=1 where matricula=:motorista");
			$stmt->bindParam("motorista", $_POST["motorista"]);
			$stmt->execute();
			echo "ok";
		} catch (Exception $e) {
			echo $e;
		}
		try {
			$conexao= new conexao_banco();
			$conexao->conectar();
			$stmt=$conexao->conectar()->prepare("update viatura set ativo=1 where placa=:viatura");
			$stmt->bindParam("viatura", $_POST["viaturas"]);
			$stmt->execute();
			echo "ok";
		} catch (Exception $e) {
			echo $e;
		}		
		;
		break;
	case "registro":
		try {
			$conexao= new conexao_banco();
			$conexao->conectar();
			$stmt=$conexao->conectar()->prepare("select * from movimentacao_viaturas_view");
			$stmt->execute();
			while ( $linha = $stmt->fetch ( PDO::FETCH_OBJ ) ) {
				echo "<tr id=" . $linha->id_registro . ">";
				echo "<td>" . $linha->viatura . "</td>";
				echo "<td>" . $linha->motorista . "</td>";
				echo "<td>" . $linha->destino . "</td>";
				$datasaida=date_create($linha->saida);
				$dataretorno=date_create($linha->retorno);
				echo "<td>" . date_format($datasaida,"d/m/Y")." ".$linha->saidahora. "</td>";
				echo "<td>" . date_format($dataretorno,"d/m/Y")." ".$linha->retornohora. "</td>";
				echo "</tr>";
			}
		} catch (Exception $e) {
		}
		;
		break;
	case "filtrar":
/*		try {*/
			$conexao= new conexao_banco();
			$conexao->conectar();
			$sql="select * from movimentacao_viaturas_view where ";
			if (($_POST["motorista"]<>"")&&($_POST["destino"]<>"")&&($_POST["viatura"]<>"")&&($_POST["data_inicio"]<>"")&&($_POST["data_fim"]<>"")){
				$sql=$sql." (matricula_motorista=:motorista) and (destino like :destino) and (placa_viatura=:placa_viatura) and ((saida between :saida and :retorno)) ";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("motorista", $_POST["motorista"]);
				$stmt->bindParam("destino", $_POST["destino"]);
				$stmt->bindParam("placa_viatura", $_POST["viatura"]);
				$data = $_POST["data_inicio"];
				$conversao = str_replace('/', '-', $data);
				$saida=date("Y-m-d", strtotime($conversao) );
				$data = $_POST["data_fim"];
				$conversao = str_replace('/', '-', $data);
				$retorno=date("Y-m-d", strtotime($conversao) );
				$stmt->bindParam("saida", $saida);
				$stmt->bindParam("retorno", $retorno);
				
			}else if (($_POST["motorista"]<>"")&&($_POST["destino"]<>"")&&($_POST["viatura"]<>"")){
				$sql=$sql." (matricula_motorista=:motorista) and (destino like :destino) and (placa_viatura=:viatura)";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("motorista", $_POST["motorista"]);
				$stmt->bindParam("destino", $_POST["destino"]);
				$stmt->bindParam("placa_viatura", $_POST["viatura"]);	
				
			}else if (($_POST["motorista"]<>"")&&($_POST["destino"]<>"")&&($_POST["data_inicio"]<>"")&&($_POST["data_fim"]<>"")){
				$sql=$sql." (matricula_motorista=:motorista) and (destino like :destino) and ((saida between :saida and :retorno)) ";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("motorista", $_POST["motorista"]);
				$stmt->bindParam("destino", $_POST["destino"]);
				$data = $_POST["data_inicio"];
				$conversao = str_replace('/', '-', $data);
				$saida=date("Y-m-d", strtotime($conversao) );
				$data = $_POST["data_fim"];
				$conversao = str_replace('/', '-', $data);
				$retorno=date("Y-m-d", strtotime($conversao) );
				$stmt->bindParam("saida", $saida);
				$stmt->bindParam("retorno", $retorno);
				
			}else if (($_POST["motorista"]<>"")&&($_POST["viatura"]<>"")&&($_POST["data_inicio"]<>"")&&($_POST["data_fim"]<>"")){
				$sql=$sql." (matricula_motorista=:motorista) and (placa_viatura=:viatura) and ((saida between :saida and :retorno)) ";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("motorista", $_POST["motorista"]);
				$stmt->bindParam("placa_viatura", $_POST["viatura"]);
				$data = $_POST["data_inicio"];
				$conversao = str_replace('/', '-', $data);
				$saida=date("Y-m-d", strtotime($conversao) );
				$data = $_POST["data_fim"];
				$conversao = str_replace('/', '-', $data);
				$retorno=date("Y-m-d", strtotime($conversao) );
				$stmt->bindParam("saida", $saida);
				$stmt->bindParam("retorno", $retorno);
			
			}else if (($_POST["motorista"]<>"")&&($_POST["destino"]<>"")){
				$sql=$sql." (matricula_motorista=:motorista) and (destino like :destino)";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("motorista", $_POST["motorista"]);
				$stmt->bindParam("destino", $_POST["destino"]);
				
			}else if (($_POST["motorista"]<>"")&&($_POST["viatura"]<>"")){
				$sql=$sql." (matricula_motorista=:motorista) and (placa_viatura=:placa_viatura)";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("motorista", $_POST["motorista"]);
				$stmt->bindParam("placa_viatura", $_POST["viatura"]);	
				
			}else if (($_POST["motorista"]<>"")&&($_POST["data_inicio"]<>"")&&($_POST["data_fim"]<>"")){
				$sql=$sql." (matricula_motorista=:motorista) and ((saida between :saida and :retorno))";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("motorista", $_POST["motorista"]);
				$data = $_POST["data_inicio"];
				$conversao = str_replace('/', '-', $data);
				$saida=date("Y-m-d", strtotime($conversao) );
				$data = $_POST["data_fim"];
				$conversao = str_replace('/', '-', $data);
				$retorno=date("Y-m-d", strtotime($conversao) );
				$stmt->bindParam("saida", $saida);
				$stmt->bindParam("retorno", $retorno);
				
			}else if (($_POST["destino"]<>"")&&($_POST["viatura"]<>"")&&($_POST["data_inicio"]<>"")&&($_POST["data_fim"]<>"")){
				$sql=$sql." (destino like :destino) and (placa_viatura=:viatura) and ((saida between :saida and :retorno))";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("destino", $_POST["destino"]);
				$stmt->bindParam("placa_viatura", $_POST["viatura"]);
				$data = $_POST["data_inicio"];
				$conversao = str_replace('/', '-', $data);
				$saida=date("Y-m-d", strtotime($conversao) );
				$data = $_POST["data_fim"];
				$conversao = str_replace('/', '-', $data);
				$retorno=date("Y-m-d", strtotime($conversao) );
				$stmt->bindParam("saida", $saida);
				$stmt->bindParam("retorno", $retorno);	
				
			}else if (($_POST["destino"]<>"")&&($_POST["viatura"]<>"")){
				$sql=$sql." (destino like :destino) and (placa_viatura=:placa_viatura)";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("destino", $_POST["destino"]);
				$stmt->bindParam("placa_viatura", $_POST["viatura"]);	
				
			}else if (($_POST["destino"]<>"")&&($_POST["data_inicio"]<>"")&&($_POST["data_fim"]<>"")){
				$sql=$sql." (destino like :destino) and ((saida between :saida and :retorno))";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("destino", $_POST["destino"]);
				$data = $_POST["data_inicio"];
				$conversao = str_replace('/', '-', $data);
				$saida=date("Y-m-d", strtotime($conversao) );
				$data = $_POST["data_fim"];
				$conversao = str_replace('/', '-', $data);
				$retorno=date("Y-m-d", strtotime($conversao) );
				$stmt->bindParam("saida", $saida);
				$stmt->bindParam("retorno", $retorno);
				
			}else if (($_POST["viatura"]<>"")&&($_POST["data_inicio"]<>"")&&($_POST["data_fim"]<>"")){
				$sql=$sql."(placa_viatura=:placa_viatura) and ((saida between :saida and :retorno))";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("placa_viatura", $_POST["viatura"]);
				$data = $_POST["data_inicio"];
				$conversao = str_replace('/', '-', $data);
				$saida=date("Y-m-d", strtotime($conversao) );
				$data = $_POST["data_fim"];
				$conversao = str_replace('/', '-', $data);
				$retorno=date("Y-m-d", strtotime($conversao) );
				$stmt->bindParam("saida", $saida);
				$stmt->bindParam("retorno", $retorno);
				
			}
			else if (($_POST["motorista"]<>"")){
				$sql=$sql." (matricula_motorista=:motorista)";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("motorista", $_POST["motorista"]);	
				
			}else if (($_POST["viatura"]<>"")){
				$sql=$sql." (placa_viatura=:viatura)";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("viatura", $_POST["viatura"]);
				
			}else if (($_POST["destino"]<>"")){
				$sql=$sql."(destino like :destino) ";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("destino", $_POST["destino"]);	
				
			}else if (($_POST["data_inicio"]<>"")&&($_POST["data_fim"]<>"")){
				$sql=$sql." ((saida between :saida and :retorno))";
				$stmt=$conexao->conectar()->prepare($sql);
				$data = $_POST["data_inicio"];
				$conversao = str_replace('/', '-', $data);
				$saida=date("Y-m-d", strtotime($conversao) );
				$data = $_POST["data_fim"];
				$conversao = str_replace('/', '-', $data);
				$retorno=date("Y-m-d", strtotime($conversao) );
				$stmt->bindParam("saida", $saida);
				$stmt->bindParam("retorno", $retorno);
				
			}
			$stmt->execute();
			while ( $linha = $stmt->fetch ( PDO::FETCH_OBJ ) ) {
				echo "<tr id=" . $linha->id_registro . ">";
				echo "<td>" . $linha->viatura . "</td>";
				echo "<td>" . $linha->motorista . "</td>";
				echo "<td>" . $linha->destino . "</td>";
				$datasaida=date_create($linha->saida);
				$dataretorno=date_create($linha->retorno);
				echo "<td>" . date_format($datasaida,"d/m/Y")." ".$linha->saidahora. "</td>";
				echo "<td>" . date_format($dataretorno,"d/m/Y")." ".$linha->retornohora. "</td>";
				echo "</tr>";
			}/*
		} catch (Exception $e) {
			echo "Erro ao acessar a base de dados";
		}*/
		;
		break;
}