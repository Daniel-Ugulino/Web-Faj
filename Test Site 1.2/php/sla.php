<?php
include 'conexao.php';

$conexao= new conexao_banco();
$conexao->conectar();

try{
    
$stm=$conexao->conectar()->prepare("select (news_image) FROM noticias WHERE id_news=8");
$stm->execute();

$sla = $stm->fetch(PDO::FETCH_OBJ)->news_image;
// $sla2 = hex2bin($sla);
// $sla3 = file_put_contents($sla2);

echo ($sla);

}
catch (Exeception $e)
{
echo($e);
}


?>
</body>
