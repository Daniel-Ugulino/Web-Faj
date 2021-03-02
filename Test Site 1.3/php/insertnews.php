<?php
include 'conexao.php';

$conexao= new conexao_banco();
$conexao->conectar();

function insert_news(){
try{
//  pega a imagem do formulário e converte para hexadecimal
$img = $_FILES['images']["tmp_name"];
$BinImg = file_get_contents($img);
$ImgHex = bin2hex($BinImg);

$news_files = $_FILES['file']['tmp_name'];
if($news_files != "")
{
    $files = file_get_contents($_FILES['file']['tmp_name']);
    $fileshex = bin2hex($files);
    echo($fileshex);
}
else
{
    $fileshex = "";
}
// abre a conexão
$conexao=new conexao_banco();
$conexao->conectar(); 
//envia os dados para o banco
$stm=$conexao->conectar()->prepare("insert into noticias values (DEFAULT,1,:Titulo,:Stitulo,:p1noticia,:p2noticia, decode('{$ImgHex}' , 'hex'), decode('{$fileshex}' , 'hex'),now(),'true')");

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
}

insert_news();

// function login()
// {
//     $stm = $conexao->conectar()->prepare("select * from usuarios where username = '$user' and senha="$senha");
//     $stm->bindParam(")
// }

?>   
</body>
</html>