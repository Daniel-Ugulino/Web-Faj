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
// $imgHex = bin2hex($sla);

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

// $stm=$conexao->conectar()->prepare("insert into noticias values (2,2,:Titulo,:Stitulo,:p1-noticia,:p2-noticia, decode('{$imgHex}' , 'hex'),null,now(),'false')");
$stm=$conexao->conectar()->prepare("insert into noticias(id_news,news_image) values (9,'$sla3');");



// $stm->bindParam("titulo",$_POST['Titulo']);
// $stm->bindParam("subtitulo",$_POST['Stitulo']);
// $stm->bindParam("noticia_p1",$_POST['p1-noticia']);
// $stm->bindParam("noticia_p2",$_POST['p2-noticia']);

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