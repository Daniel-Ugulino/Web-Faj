<?php
include 'conexao.php';
session_start();
$op = $_SESSION['op'];

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
$stm=$conexao->conectar()->prepare("insert into noticias values (DEFAULT,1,:Titulo,:Stitulo,:p1noticia,:p2noticia, decode('{$ImgHex}' , 'hex'), null ,now(),'true')");

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

// function login()
// {
//     $stm = $conexao->conectar()->prepare("select * from usuarios where username = '$user' and senha="$senha");
//     $stm->bindParam("")
// }

function news_menu()
{
    try{
    $i = 0;
    $conexao= new conexao_banco();

    $conexao->conectar();
    $stm = $conexao->conectar()->prepare("select * from noticias order by id_news DESC");
    $stm->execute();
    $stm->fetch(PDO::FETCH_OBJ);
    $news = [];

// for($i=0; i<6;i++)
// {
//     $news[$i] = array($stm['id_news'],$stm['titulo'],$stm['subtitulo'],$stm['news_image']);
// })

    foreach($stm as $newsval)
    {
        $news[$i] = array($newsval['id_news'],$newsval['titulo'],$newsval['subtitulo'],$newsval['news_image']);
        $i++;
    }

    $_SESSION['noticias'] = $news;
    
    $y = 0;
    foreach ($_SESSION['noticias'] as $noticias)
    {   
        $id[$y] = $noticias[0];
        $titulo[$y] = $noticias[1];
        $subtitulo[$y] = $noticias[2];
        $img[$y] = $noticias[3];
        $y++;
    }

    echo($id[1]);
    echo($titulo[1]);
    echo($subtitulo[1]);
    }
    catch(Exeception $e)
    {
        echo($e);
    }
}

function getnews()
{
    
}

switch($op)
{
    case("news-create"):insert_news();break;
    // case("logar"):login();break;
    case("news-menu"):news();break;
    case("news-select"):getmews();break
}

?>   
</body>
</html>