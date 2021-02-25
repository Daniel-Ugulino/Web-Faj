<?php
include 'conexao.php';

$conexao= new conexao_banco();
$conexao->conectar();


try{

//  pega a imagem do formulário e converte para hexadecimal
$img = $_FILES['images']["tmp_name"];
$BinImg = file_get_contents($img);
$ImgHex = bin2hex($BinImg);

//  pega os arquivos do formulário e converte para hexadecimal
$filesQTD = count($_FILES['file']['tmp_name']);
$files = [];
$allfiles = "";
for ($i=0 ; $i < $filesQTD; $i++ ){
    $files[$i] = file_get_contents($_FILES['file']['tmp_name'][$i]);
    $allfiles = $allfiles . chr(13) . $files[$i];
}
$fileshex = bin2hex($allfiles);


// abre a conexão

$conexao=new conexao_banco();
$conexao->conectar(); 

//envia os dados para o banco
$stm=$conexao->conectar()->prepare("insert into noticias values (22,null,:Titulo,:Stitulo,:p1noticia,:p2noticia, decode('{$ImgHex}' , 'hex'), decode('{$fileshex}' , 'hex'),now(),'false')");

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