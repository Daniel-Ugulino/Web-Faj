<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require_once "conexao.php";
if (isset($_POST["op"])){
	$operacao=$_POST["op"];
}
switch ($operacao) {
	case "listarvisitante":
		try{
			$conexao=new conexao_banco();
			$conexao->conectar();
			$stmt = $conexao->conectar()->prepare ( "select ra.`idregistro-acesso` as id,upper(v.nome) as nome,DATE_FORMAT(ra.data_entrada,'%d/%m/%Y %T') as data,s.descricao,ra.cracha from registro_acesso ra 
															left join visitante v on (v.cpf=ra.visitante)
															left join setor s on (s.idsetor=ra.setor) where ra.data_saida is null order by data_entrada;" );
			$stmt->execute ();
			while ( $linha = $stmt->fetch ( PDO::FETCH_OBJ ) ) {
				echo "<tr id=" . $linha->id . ">";
				echo "<td class=n>" . $linha->cracha . "</td>";
				echo "<td class=v>" . $linha->nome . "</td>";
				echo "<td class=d>" . $linha->descricao . "</td>";
				echo "<td class=h>" . $linha->data . "</td>";
				echo "</tr>";
			}
		}catch (Exception $e){
			echo "Erro ao acessar a base de dados";
		}
		break;
	case "listarviaturas":
		try {
			$conexao= new conexao_banco();
			$conexao->conectar();
			$stmt=$conexao->conectar()->prepare("select * from registro_viaturas_view");
			$stmt->execute();
			while ( $linha = $stmt->fetch ( PDO::FETCH_OBJ ) ) {
				echo "<tr id=" . $linha->id_registro . ">";
				echo "<td class=motorista>" . $linha->motorista . "</td>";
				echo "<td class=viatura>" . $linha->viatura . "</td>";
				echo "<td class=destino>" . $linha->destino . "</td>";
				echo "<td class=data>" . $linha->data_saida. "</td>";
				echo "</tr>";
			}
		} catch (Exception $e) {
			echo "Erro ao acessar a base de dados";
		}
		break;
	case "registrar-saida":
		try{
			$conexao=new conexao_banco();
			$conexao->conectar();
			$busca=$conexao->conectar()->prepare("select cracha from registro_acesso where `idregistro-acesso`=:id");
			$busca->bindParam(":id", $_POST["id"]);
			$busca->execute();
			$linhaCracha=$busca->fetch(PDO::FETCH_OBJ);
			$numero=$linhaCracha->cracha;
			$registro=$conexao->conectar()->prepare( "update registro_acesso set data_saida=current_timestamp() where `idregistro-acesso`=:id" );
			$registro->bindParam(":id", $_POST["id"]);
			$registro->execute ();
			$registrocracha=$conexao->conectar()->prepare("update cracha set status=0 where numero=".$numero);
			$registrocracha->execute();
			$stmt = $conexao->conectar()->prepare ( "select ra.`idregistro-acesso` as id,upper(v.nome) as nome,DATE_FORMAT(ra.data_entrada,'%d/%m/%Y %T') as data,s.descricao,ra.cracha from registro_acesso ra
															left join visitante v on (v.cpf=ra.visitante)
															left join setor s on (s.idsetor=ra.setor) where ra.data_saida is null order by data_entrada;" );
			$stmt->execute ();
			while ( $linha = $stmt->fetch ( PDO::FETCH_OBJ ) ) {
				echo "<tr id=" . $linha->id . ">";
				echo "<td class=n>" . $linha->cracha . "</td>";
				echo "<td class=v>" . $linha->nome . "</td>";
				echo "<td class=d>" . $linha->descricao . "</td>";
				echo "<td class=h>" . $linha->data . "</td>";
				echo "</tr>";
			}
		}catch (Exception $e){
			echo "Erro ao acessar a base de dados";
		}
		break;
}