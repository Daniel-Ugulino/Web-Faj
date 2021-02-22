<?php
include 'conexao.php';

$conexao= new conexao_banco();
$conexao->conectar();


//pega a imagem do form e converte para hexadecimal

$sla = $_FILES['images'];
$img = file_get_contents($sla);
$imgHex = bin2hex($img);
echo($sla);

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

// // abre a conexão
// $conexao=new conexao_banco();
// $conexao->conectar(); 

// $stm=$conexao->conectar()->prepare("insert into noticias values (1,:Titulo,:Stitulo,:p1-noticia,:p2-noticia,$imgHex,$fileshex,now,'false')");

// $stm->bindParam("titulo",$_POST['Titulo']);
// $stm->bindParam("subtitulo",$_POST['Stitulo']);
// $stm->bindParam("noticia_p1",$_POST['p1-noticia']);
// $stm->bindParam("noticia_p2",$_POST['p2-noticia']);
// $stm->execute();


// echo("<script>alert('Noticia cadastrada')</script>");
// }
// catch(Exception $e)
// {
// echo("<script>alert('Erro ao criar noticia')</script>");
// }
// ?>   
</body>
</html>