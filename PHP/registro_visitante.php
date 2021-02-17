<?php
require_once 'conexao.php';
if (isset ( $_POST ['op'] )) {
	$operacao = $_POST ['op'];
}
switch ($operacao) {
    /*case onde será verificado se o visitante ja se encontra como dentro das instalações*/    
    case "verificar":
        //header ( 'Content-Type: text/html; charset=utf-8' );
        $conexao = new conexao_banco();
        $conexao->conectar();
        $stmt=$conexao->conectar()->prepare("SELECT * FROM `controle-acesso`.registro_acesso where visitante=:cpf and data_saida is null;");
        $stmt->bindParam ( ":cpf", $_POST ["cpf"] );
        $stmt->execute();
        if($stmt->rowCount()==1){
            echo json_encode("true");
        }else{
            echo json_encode("false");
        }
        /*
		$linha = $stmt->fetch ( PDO::FETCH_OBJ );
        if ($linha->contagem==0){
            echo "0";
        }else{
            echo "1";    
        }*/
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
	case "cadastro" :
		if (isset ( $_POST ["veiculo"] )) {
			try {
				$contato=strtoupper($_POST ["contato"]);
				$conexao = new conexao_banco ();
				$conexao->conectar ();
				//Registra a entrada do visitante
				$stmt = $conexao->conectar ()->prepare ( "insert into registro_acesso values(null,:cpf,current_timestamp(),null,:setor,:cracha,:contato,:obs,:veiculo)" );
				$stmt->bindParam ( ":cpf", $_POST ["visitante"] );
				$stmt->bindParam ( ":setor", $_POST ["setor"] );
				$stmt->bindParam ( ":cracha", $_POST ["cracha"] );
				$stmt->bindParam ( ":contato", $contato);
				$stmt->bindParam ( ":obs", $_POST ["obs"] );
				$stmt->bindParam ( ":veiculo", $_POST ["veiculo"] );
				$stmt->execute ();
			} catch ( Exception $e ) {
				echo "Erro ao acessar a base de dados";
			}
		} else {
			try {
				$contato=strtoupper($_POST ["contato"]);
				$conexao = new conexao_banco ();
				$conexao->conectar ();
				$stmt = $conexao->conectar ()->prepare ( "insert into registro_acesso values(null,:cpf,current_timestamp(),null,:setor,:cracha,:contato,:obs,null)" );
				$stmt->bindParam ( ":cpf", $_POST ["visitante"] );
				$stmt->bindParam ( ":setor", $_POST ["setor"] );
				$stmt->bindParam ( ":cracha", $_POST ["cracha"] );
				$stmt->bindParam ( ":contato", $contato );
				$stmt->bindParam ( ":obs", $_POST ["obs"] );
				$stmt->execute ();
			} catch ( Exception $e ) {
				echo "Erro ao acessar a base de dados";
			}
		}
		try {
			$conexao = new conexao_banco ();
			$conexao->conectar ();
			$stmt = $conexao->conectar ()->prepare ( "update cracha set status=1 where numero=:cracha" );
			$stmt->bindParam ( ":cracha", $_POST ["cracha"] );
			$stmt->execute ();
		} catch ( Exception $e ) {
			echo "Erro ao acessar a base de dados";
		}
		break;
	case "registro" :
		try {
			$conexao = new conexao_banco ();
			$conexao->conectar ();
			$stmt = $conexao->conectar ()->prepare ( "SELECT id,cpf,nome,foto,empresa,setor,contato, DATE_FORMAT(entrada, '%d/%m/%Y  %H:%i') AS entrada,DATE_FORMAT(saida, '%d/%m/%Y  %H:%i') AS saida FROM registro_acesso_view" );
			$stmt->execute ();
			while ( $linha = $stmt->fetch ( PDO::FETCH_OBJ ) ) {
				echo "<tr id=" . $linha->id . ">";
				echo "<td class=c>" . $linha->cpf . "</td>";
				echo "<td class=nome>" . $linha->nome . "</td>";
				echo "<td class=descricao>" . $linha->setor . "</td>";
				echo "<td class=contato>" . $linha->contato . "</td>";
				echo "<td class=entrada>" . $linha->entrada . "</td>";
				echo "<td class=saida>" . $linha->saida . "</td>";
				echo "</tr>";
			}
		} catch ( Exception $e ) {
		}
		break;
	case "filtro_registro" :
		/*try {*/
			if ($_POST["conteudo"]!=""){
				$conteudo=$_POST["conteudo"].'%';
			}else{
				$conteudo="";
			};
			if ($_POST["datainicio"]!=""){
				$data = $_POST["datainicio"];
				$conversao = str_replace('/', '-', $data);
				$datainicio=date("Y-m-d", strtotime($conversao) );
			}else{
				$datainicio="";
			};
			if ($_POST["datafim"]!=""){
				$data = $_POST["datafim"].' 23:59:59';
				$conversao = str_replace('/', '-', $data);
				$datafim= date("Y-m-d H:i", strtotime($conversao) );
			}else{
				$datafim="";
			};
			if ($_POST["destino"]!=""){
				$destino=$_POST["destino"];
			}else{
				$destino='';
			}
			
			$conexao = new conexao_banco ();
			$conexao->conectar ();
			
			
			$sql=( "SELECT id,cpf,nome,foto,empresa,setor,contato, DATE_FORMAT(entrada, '%d/%m/%Y  %H:%i') AS entrada,DATE_FORMAT(saida, '%d/%m/%Y  %H:%i') AS saida FROM registro_acesso_view where ");
			
			if (($conteudo!="")&&($destino!="")&&($datainicio!="")&&($datafim!="")){
				$sql=$sql." (((cpf=:conteudo) or (nome like :conteudo)) and (id_setor = :destino) and ( entrada between (:inicio) and (:fim)))  order by entrada desc;";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("conteudo",$conteudo,PDO::PARAM_STR);
				$stmt->bindParam("destino",$destino);
				$stmt->bindParam("inicio",$datainicio);
				$stmt->bindParam("fim",$datafim);
				
			}else if (($conteudo!="")&&($destino!="")){
				$sql=$sql." ((cpf=:conteudo) or (nome like :conteudo)) and (id_setor = :destino) order by entrada desc;";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("conteudo",$conteudo,PDO::PARAM_STR);
				$stmt->bindParam("destino",$destino);
			
			}else if (($conteudo!="") and ($datainicio!="")&&($datafim!="")){
				$sql=$sql."((cpf=:conteudo) or (nome like :conteudo)) and ( entrada between (:inicio) and (:fim)) order by entrada desc;";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("conteudo",$conteudo,PDO::PARAM_STR);
				$stmt->bindParam("inicio",$datainicio);
				$stmt->bindParam("fim",$datafim);
			}else if (($destino!="") and ($datainicio!="")&&($datafim!="")){
				$sql=$sql." ((id_setor = :destino)) and ( entrada between (:inicio) and (:fim)) order by entrada desc;";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("destino",$destino);
				$stmt->bindParam("inicio",$datainicio);
				$stmt->bindParam("fim",$datafim);
			}else if (($destino!="")){
				$sql=$sql." ((id_setor = :destino)) order by entrada desc;";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("destino",$destino);
			}else if (($conteudo!="")){
				$sql=$sql." ((cpf=:conteudo) or (nome like :conteudo)) order by entrada desc;";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("conteudo",$conteudo,PDO::PARAM_STR);
			}else if (($datainicio!="")&&($datafim!="")){
				$sql=$sql." ((id_setor = :destino)) order by entrada desc;";
				$stmt=$conexao->conectar()->prepare($sql);
				$stmt->bindParam("inicio",$datainicio);
				$stmt->bindParam("fim",$datafim);
			}
			
			
			
			
			
			
			
			
			
			
			
			
			//$sql=$sql." (matricula_motorista=:motorista) and (destino like :destino) and (placa_viatura=:placa_viatura) and ((saida between :saida and :retorno)) ";
			
			
			
			//$stmt = $conexao->conectar ()->prepare ( "SELECT id,cpf,nome,foto,empresa,setor,contato, DATE_FORMAT(entrada, '%d/%m/%Y  %H:%i') AS entrada,DATE_FORMAT(saida, '%d/%m/%Y  %H:%i') AS saida FROM `controle-acesso`.registro_acesso_view where ((cpf=:cpf) or (nome like :conteudo) or (id_setor = :destino) or ( entrada between (:inicio) and (:fim))) order by entrada desc;" );
			/*$stmt->bindParam("cpf", $_POST["conteudo"]);
			$stmt->bindParam("conteudo",$conteudo,PDO::PARAM_STR);
            $stmt->bindParam("destino",$_POST["destino"],PDO::PARAM_STR);
			$stmt->bindParam("inicio",$datainicio,PDO::PARAM_STR);
			$stmt->bindParam("fim",$datafim,PDO::PARAM_STR);*/
			
			$stmt->execute();
			while ( $linha = $stmt->fetch ( PDO::FETCH_OBJ ) ) {
				echo "<tr id=" . $linha->id . ">";
				echo "<td class=c>" . $linha->cpf . "</td>";
				echo "<td class=nome>" . $linha->nome . "</td>";
				echo "<td class=descricao>" . $linha->setor . "</td>";
				echo "<td class=contato>" . $linha->contato . "</td>";
				echo "<td class=entrada>" . $linha->entrada . "</td>";
				echo "<td class=saida>" . $linha->saida . "</td>";
				echo "</tr>";
			}
		/*} catch ( Exception $e ) {
            echo "Erro ao acessar a base de dados";
		}*/
		break;
				
}