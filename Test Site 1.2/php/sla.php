<?php
include 'conexao.php';

$conexao= new conexao_banco();
$conexao->conectar();

try{
    
$stm=$conexao->conectar()->prepare("select encode(news_image, 'base64') FROM noticias where id_news='8'");
$stm->execute();

$sla = $stm->fetch(PDO::FETCH_OBJ);
// $sla2 = hex2bin($sla);
// $sla3 = file_put_contents($sla2);
echo ($sla->encode);
}
catch (Exeception $e)
{
echo($e);
}


?>
</body>
