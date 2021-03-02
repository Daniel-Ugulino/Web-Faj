<?php
include 'conexao.php';
$conexao= new conexao_banco();
$conexao->conectar();
try{
$stm=$conexao->conectar()->prepare("select encode(news_image, 'base64') as imagem FROM noticias where id_news='3'");

$newstext = $conexao->conectar()->prepare("select * from noticias");

$newstext->execute();
$newstext->fetch(PDO::FETCH_OBJ);
foreach ($newstext as $news)
{
    echo($news['titulo'] . " ");
    echo($news['subtitulo'] . " ");
    echo($news['noticia_p1'] . " ");
    echo($news['noticia_p2'] . " ");
    echo($news['post_day'] . " ");
}

$stm->execute();
$sla = $stm->fetch(PDO::FETCH_OBJ);
$sla1 = ($sla->imagem);

$stm=$conexao->conectar()->prepare("select encode(news_files, 'base64') as file FROM noticias where id_news='3'");
$stm->execute();
$sla2 = $stm->fetch(PDO::FETCH_OBJ);
$sla3 = ($sla2->file);
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
    <a href="<?=$sla3?>">addassasaadd</a>
</body>
</html>