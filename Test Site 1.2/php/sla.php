<?php
include 'conexao.php';
$conexao= new conexao_banco();
$conexao->conectar();
try{
$stm=$conexao->conectar()->prepare("select encode(news_image, 'base64') FROM noticias where id_news='6'");
$stm->execute();
$sla = $stm->fetch(PDO::FETCH_OBJ);
$sla1 = ($sla->encode);

$stm=$conexao->conectar()->prepare("select encode(news_files, 'base64') FROM noticias where id_news='21'");
$stm->execute();
$sla2 = $stm->fetch(PDO::FETCH_OBJ);
$sla3 = ($sla2->encode);

}
catch (Exeception $e)
{
echo($e);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="data:image;base64,<?=$sla1?>" alt="">
    <a href=data:file;base64<?=$sla3?>></a>
</body>
</html>