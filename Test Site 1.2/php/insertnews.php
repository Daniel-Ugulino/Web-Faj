<?php
include 'conexao.php';

$conexao= new conexao_banco();
$conexao->conectar();


//pega a imagem do form e converte para hexadecimal
try{
$sla = $_FILES['images']["tmp_name"];
$sla1 = file_get_contents($sla);
$sla3 = bin2hex($sla1);
echo($sla3);

// //pega os arquivos do form e converte para hexadecimal
// $filesQTD = count($_FILES['news-file']);
// $files = [];
// echo($filesQTD);
// exit();
// for( $i=0 ; i < $filesQTD; ++i){
//     $files[$i] = file_get_contents($_FILES['news-file'][$i]);
// }
// $allfiles = $files[];
// $fileshex = bin2hex($allfiles);

// abre a conexão

$conexao=new conexao_banco();
$conexao->conectar(); 

$stm=$conexao->conectar()->prepare("insert into noticias values (16,null,:Titulo,:Stitulo,:p1noticia,:p2noticia, decode('{$sla3}' , 'hex'),null,now(),'false')");
// $stm=$conexao->conectar()->prepare("insert into noticias(id_news, news_image) values ('16', decode('{$sla3}' , 'hex'));");

$stm->bindParam("Titulo",$_POST['Titulo']);
$stm->bindParam("Stitulo",$_POST['Stitulo']);
$stm->bindParam("p1noticia",$_POST['p1-noticia']);
$stm->bindParam("p2noticia",$_POST['p2-noticia']);

$stm->execute();
echo("<script>alert('Noticia cadastrada')</script>");
}
catch(Exception $e)
{
echo("<script>alert('Erro ao criar noticia')</script>");
echo($e);
}
?>   
</body>
</html>