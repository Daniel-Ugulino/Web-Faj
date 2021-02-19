<?php
require 'conexao.php';

$conexao=new conexao_banco();
$conexao->conectar();
$datenow = date("d/m/Y");
try{
//pega a imagem do form e converte para hexadecimal
$img = file_get_contents($_POST['news-image']);
$imgHex = bin2hex($img);

//pega os arquivos do form e converte para hexadecimal
$filesQTD = count($_FILES['news-file']);
$files = [];

for( $i=0 ; i < $filesQTD; i++){
    $files[$i] = file_get_contents($_FILES['news-file'][$i]);
}
$allfiles = $files[];
$fileshex = bin2hex($allfiles);

// abre a conexão
$conexao=new conexao_banco();
$conexao->conectar(); 

$stm=$conexao->conectar()->prepare("insert into noticias values (1,:Titulo,:Stitulo,:p1-noticia,:p2-noticia,$imgHex,$fileshex,$datenow,'false')");

$stm->bindParam("titulo",$_POST['Titulo']);
$stm->bindParam("subtitulo",$_POST['Stitulo']);
$stm->bindParam("noticia_p1",$_POST['p1-noticia']);
$stm->bindParam("noticia_p2",$_POST['p2-noticia']);
$stm->execute();


echo("<script>alert('Noticia cadastrada')</script>");
}
catch(Exception $e)
{
echo("<script>alert('Erro ao criar noticia')</script>");
}
?>   
</body>
</html>