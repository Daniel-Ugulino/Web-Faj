<?php
include 'conexao.php';
session_start();

$op = $_POST['op'];
echo($op);
$conexao= new conexao_banco();
$conexao->conectar();

switch($op)
{
    case("news-create"):insert_news();break;
    case("logar"):login();break;
    case("news-menu"):news_menu();break;
    case("news-select"):getnews();break;
}

function insert_news(){
try{
//  pega a imagem do formulário e converte para hexadecimal
$img = $_FILES['images']["name"];
$extI = pathinfo($img, PATHINFO_EXTENSION);
$newNameI = md5($img) . "." . $extI;
$pathI = "Arquivos/news-imgs/";
$sla = move_uploaded_file($_FILES['images']["tmp_name"], "../" . $pathI.$newNameI);
$news_img = $pathI.$newNameI;

// $BinImg = file_get_contents($img);
// $ImgHex = bin2hex($BinImg);

$news_files = $_FILES['file']['tmp_name'];
if($news_files != "")
{
    $img = $_FILES['file']["name"];
    $extF = pathinfo($img, PATHINFO_EXTENSION);
    $newNameF = md5($img) . "." . $extF;
    $pathF = 'Arquivos/news-files/';
    $sla = move_uploaded_file($_FILES['file']["tmp_name"], "../" . $pathF.$newNameF);
    $news_file = $pathF.$newNameF;
}
else
{
    $news_file = "";
}

// abre a conexão
$conexao=new conexao_banco();
$conexao->conectar(); 

//envia os dados para o banco

$stm=$conexao->conectar()->prepare("insert into noticias values (DEFAULT,1,:Titulo,:Stitulo,:p1noticia,:p2noticia, '$news_img' , '$news_file' ,now(),'true')");

$stm->bindParam("Titulo",$_POST['Titulo']);
$stm->bindParam("Stitulo",$_POST['Stitulo']);
$stm->bindParam("p1noticia",$_POST['p1noticia']);
$stm->bindParam("p2noticia",$_POST['p2noticia']);
$stm->execute();
echo("<script>alert('Noticia cadastrada')</script>");
}

catch(Exception $e)
{
echo("<script>alert('Erro ao criar noticia')</script>");
echo($e);
}
}

function login()
{
    $conexao = new conexao_banco();
    $conexao->conectar();
    $stm = $conexao->conectar()->prepare("select * from usuario where username = :username and senha= :senha");
    $stm->bindParam("username",$_POST['usuario']);
    $stm->bindParam("senha",$_POST['senha']);
    $stm->execute();
    if($stm->rowCount() == 1)
    {
        $userData = $stm->fetch(PDO::FETCH_OBJ);
        $_SESSION['user_id'] = $userData->id_user;
        header('Location: ../create-news.php');
    }
}

 function news_menu()
{
    try{
    $i = 0;
    $conexao = new conexao_banco();
    $conexao->conectar();
    $stm = $conexao->conectar()->prepare("select * from noticias order by id_news DESC");
    $stm->execute();
    $news = [];

    
    while ($newsval = $stm->fetch(PDO::FETCH_OBJ))
    {
        $news[$i] = array($newsval->id_news, $newsval->titulo, $newsval->subtitulo, $newsval->news_image);
        $i++;
    }
    
    $_SESSION['noticia-menu'] = $news;
    }
    
    catch(Exeception $e)
    {
        echo($e);
    }
}

function getnews()
{
    try{

        $conexao= new conexao_banco();
        $i = 0;
        $conexao->conectar();
        $_SESSION['id_news'] = $_POST["id"];
        $selected_news = $_SESSION['id_news'];
        $stm = $conexao->conectar()->prepare("select * from noticias where id_news = $selected_news");
        $stm->execute();
        $news = [];
        $newsval = $stm->fetch(PDO::FETCH_OBJ);
    
        $news[0] = $newsval->id_news;
        $news[1] = $newsval->titulo;
        $news[2] = $newsval->subtitulo;
        $news[2] = $newsval->noticia_p1;
        $news[3] = $newsval->noticia_p2;
        $news[4] = $newsval->news_image;
        $news[5] = $newsval->news_files;
        $news[6] = $newsval->post_day;

        $_SESSION['noticia'] = $news;

        $y = 0;
        
        // foreach($_SESSION['noticia'] as $news)
        // {
        // echo($news[]); 
        // $y++;
        // }


        echo($selected_news . $news[1]);
        
        }
        catch(Exeception $e)
        {
            echo($e);
        }
}
?>   
</body>
</html>