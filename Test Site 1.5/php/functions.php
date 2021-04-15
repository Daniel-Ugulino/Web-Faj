<?php
include 'conexao.php';
session_start();

$op = $_POST['op'];
$conexao = new conexao_banco();
$conexao->conectar();

switch ($op) {
    case ("news-create"):
        insert_news();
        break;

    case ("logar"):
        login();
        break;

    case ("news_menu_carrousel"):
        news_menu_carrousel();
        break;

    case ("news_menu_card"):
        news_menu_card();
        break;

    case ("news-select"):
        getnews();
        break;

    case ("update_key"):
        update_key();
        break;

    case ("card_control"):
        news_control_card();
        break;

    case ("news_situation"):
        news_situation();
        break;
}

function insert_news()
{
    try {
        $creator = $_SESSION['user_id'];
        //  pega a imagem do formulário e converte para hexadecimal
        $img = $_FILES['images']["name"];
        $extI = pathinfo($img, PATHINFO_EXTENSION);
        $newNameI = md5($img) . time() . "." . $extI;
        $pathI = "Arquivos/news-imgs/";
        $sla = move_uploaded_file($_FILES['images']["tmp_name"], "../" . $pathI . $newNameI);
        $news_img = $pathI . $newNameI;

        // $BinImg = file_get_contents($img);
        // $ImgHex = bin2hex($BinImg);
        $news_files = $_FILES['file']['tmp_name'];
        if ($news_files != "") {
            $img = $_FILES['file']["name"];
            $extF = pathinfo($img, PATHINFO_EXTENSION);
            $newNameF = md5($img) . time() . "." . $extF;
            $pathF = 'Arquivos/news-files/';
            $sla = move_uploaded_file($_FILES['file']["tmp_name"], "../" . $pathF . $newNameF);
            $news_file = $pathF . $newNameF;
        } else {
            $news_file = "";
        }

        // abre a conexão
        $conexao = new conexao_banco();
        $conexao->conectar();

        //envia os dados para o banco

        if ($_POST['post_data'] == 1) {
            $stm = $conexao->conectar()
                ->prepare("insert into noticias values (DEFAULT,$creator,:Titulo,:p1noticia,:p2noticia, '$news_img' , '$news_file' ,now(),'true')");
        } else if ($_POST['post_data'] == 2) {
            $id = $_POST['id'];
            echo ($_FILES['images']["name"]);

            $stm = $conexao->conectar()
                ->prepare("update noticias set titulo = :Titulo, noticia_p1 = :p1noticia, noticia_p2 = :p2noticia, post_day = now(), news_image = '$news_img', news_files = '$news_file' where id_news = '$id'");


            // if ($_FILES['images']["name"] == null || $_FILES['file']['tmp_name'] == null) {
            //     $stm = $conexao->conectar()
            //         ->prepare("update noticias set titulo = :Titulo , subtitulo = :Stitulo , noticia_p1 = :p1noticia, noticia_p2 = :p2noticia, post_day = now() where id_news = '$id'");
            // }

            if ($_FILES['images']["name"] == null) {
                $stm = $conexao->conectar()
                    ->prepare("update noticias set titulo = :Titulo , noticia_p1 = :p1noticia, noticia_p2 = :p2noticia, post_day = now(), news_files = '$news_file' where id_news = '$id'");
            } else if ($_FILES['file']['tmp_name'] == null) {
                $stm = $conexao->conectar()
                    ->prepare("update noticias set titulo = :Titulo , noticia_p1 = :p1noticia, noticia_p2 = :p2noticia, post_day = now(), news_image = '$news_img' where id_news = '$id'");
            }
        }
        $stm->bindParam("Titulo", $_POST['Titulo']);
        $stm->bindParam("p1noticia", $_POST['p1noticia']);
        $stm->bindParam("p2noticia", $_POST['p2noticia']);
        $stm->execute();
        echo ("<script>alert('Noticia cadastrada')</script>");
    } catch (Exception $e) {
        echo ("<script>alert('Erro ao criar noticia')</script>");
        echo ($e);
    }
}

function login()
{
    $conexao = new conexao_banco();
    $conexao->conectar();
    $stm = $conexao->conectar()->prepare("select * from usuario where username = :username");
    $stm->bindParam("username", $_POST['usuario']);

    $stm->execute();
    if ($stm->rowCount() == 1) {
        $userData = $stm->fetch(PDO::FETCH_OBJ);
        // session_name(md5($userData->id_user . $_SERVER['REMOTE_ADDR']));
        $_SESSION['user_id'] = $userData->id_user;
        $_SESSION['name_user'] = $userData->username;
        $_SESSION['cargo'] = $userData->cargo;
        if ($userData->senha == "abc,123" && htmlspecialchars($_POST['senha']) == "abc,123") {
            ob_end_clean();
            echo ("2");
        } else if (password_verify(htmlspecialchars($_POST['senha']), $userData->senha)) {
            ob_end_clean();
            echo ("1");
        }
    }
}

function news_menu_carrousel()
{
    try {
        $i = 0;
        $conexao = new conexao_banco();
        $conexao->conectar();
        $stm = $conexao->conectar()->prepare("select * from noticias where situação order by id_news DESC limit 3");
        $stm->execute();
        $stm->rowCount();
        while ($newsval = $stm->fetch(PDO::FETCH_OBJ)) {
            if ($i == 0) {
                echo ('
                <div class="carousel-item news active" id="' . $newsval->id_news . '">
                    <div class="News justify-content-center">
                    <div class="slide-text">
                        <p style="font-size:1.2em;">' . $newsval->titulo . '</p>
                    </div>
                    <img src="' . $newsval->news_image . '">
                    </div>
                </div>
            ');
            } else if ($i > 0 && $i <= 2) {
                echo ('
                <div class="carousel-item news" id="' . $newsval->id_news . '">
                    <div class="News justify-content-center">
                    <div class="slide-text">
                        <p style="font-size:1.2em;">' . $newsval->titulo . '</p>
                    </div>
                    <img src="' . $newsval->news_image . '">
                    </div>
                </div>
            ');
            };
            $i++;
        };
    } catch (Exception $e) {
        echo ($e);
    }
}

function news_menu_card()
{
    try {
        $lastN = 0;
        $i = 0;
        $conexao = new conexao_banco();
        $conexao->conectar();
        $pages = 3;

        if (isset($_POST["page_index"])) {
            $pages = $_POST["page_index"];
        }

        $id = $conexao->conectar()->prepare("select MAX(id_news) as last from noticias ");
        $id->execute();
        while ($last = $id->fetch(PDO::FETCH_OBJ)) {
            $lastN = $last->last - $pages;
        };

        $stm = $conexao->conectar()->prepare("select * from noticias where id_news <= $lastN AND situação = true order by id_news DESC ");
        $stm->execute();
        //$news = [];
        while ($newsval = $stm->fetch(PDO::FETCH_OBJ)) {
            if ($i <= 3) {
                echo ('
                <div class="card news" id="' . $newsval->id_news . '">
                <img src="' . $newsval->news_image . '" class="card-img-top card-img">
                <div class="card-body">
                  <p class="card-text" style="text-decoration: none;">' . $newsval->titulo . '</p>
                </div>
              </div>');
            }
            $i++;
        };
    } catch (Exception $e) {
        echo ($e);
    }
}

function getnews()
{
    try {

        $conexao = new conexao_banco();
        $conexao->conectar();
        if (isset($_POST["id"])) {
            $_SESSION['id_news'] = $_POST["id"];
        }
        if (isset($_POST["show_data"])) {
            $_SESSION['show_data'] = $_POST["show_data"];
        }

        // else{
        //     header("Location: main.php");
        // }
        $selected_news = $_SESSION['id_news'];

        $data_show = $_SESSION['show_data'];

        $stm = $conexao->conectar()->prepare("select id_news,titulo,noticia_p1,noticia_p2,news_image,news_files,post_day,situação,username from noticias inner join usuario on usuario.id_user = noticias.idf_user where id_news = $selected_news
        ");

        $stm->execute();

        $newsval = $stm->fetch(PDO::FETCH_OBJ);

        if ($data_show == 1) {

            $p1 = (explode("\n\r", $newsval->noticia_p1));
            $p1_tags = "";

            $p2 = (explode("\n\r", $newsval->noticia_p2));
            $p2_tags = "";

            for ($i = 0; $i < count($p1); $i++) {
                $p1_tags = $p1_tags . ('<p>' . $p1[$i] . '</p>');
            }

            for ($i = 0; $i < count($p2); $i++) {
                $p2_tags = $p2_tags . ('<p>' . $p2[$i] . '</p>');
            }

            echo ('
        <div class="Cabeçalho">
            <h2>' . $newsval->titulo . '</h2>
            <h5>' . $newsval->username . ' - ' . $newsval->post_day . '</h5>
        </div>
        <div class="row d-flex justify-content-center">
            <img src="' . $newsval->news_image . '" alt="" class="img">
            <div class="news-paragraph1">' . $p1_tags . '</div>
        </div>
        <div class="row justify-content-center">
            <div class="news-paragraph2">' . $p2_tags . '</div>
        </div>
        <div class="row justify-content-center">
            <img src="Arquivos\Icones\FAJCMC-Sem-fundo.png" alt="" class="Logo-Faj">
            <a href="' . $newsval->news_files . '" class="file-text">Clique para obter o arquivo da noticia</a>
        </div>
        ');
        } else if ($data_show == 2) {
            // $logged_user = $_SESSION['user_id'];

            // array_push($newsval, $logged_user);
            // echo json_encode($logged_user);
            echo bin2hex(json_encode($newsval));
        }
    } catch (Exception $e) {
        echo ($e);
    }
}

function update_key()
{
    try {
        $loged_user = $_SESSION['user_id'];
        $conexao = new conexao_banco();
        $conexao->conectar();
        $New_S = $_POST['senha_nova'];
        $cripted_N = password_hash($New_S, PASSWORD_DEFAULT);

        $stm = $conexao->conectar()->prepare("update usuario set senha = '$cripted_N' where id_user = '$loged_user' AND  senha = :old_S");
        $stm->bindParam("old_S", $_POST['senha_antiga']);
        $stm->execute();
        if ($_POST['senha_antiga'] != "abc,123") {
            echo ("2");
        } else {
            echo ("1");
        }
    } catch (Exception $e) {
        echo ("<script>alert('Senha alterada com sucesso');</script>");
    }
}

function news_control_card()
{
    try {
        $lastN = 0;
        $i = 0;
        $conexao = new conexao_banco();
        $conexao->conectar();
        $pages = 0;
        $cargo = $_SESSION['cargo'];
        echo ("<script>sessionStorage.setItem('cargo' ,'" . $cargo . "' )</script>");

        if (isset($_POST["page_index"])) {
            $pages = $_POST["page_index"];
        }

        $id = $conexao->conectar()->prepare("select MAX(id_news) as last from noticias ");
        $id->execute();
        while ($last = $id->fetch(PDO::FETCH_OBJ)) {
            $lastN = $last->last - $pages;
        };

        if (isset($_POST["name"])) {
            $name = $_POST["name"];
            $stm = $conexao->conectar()->prepare("select * from noticias inner join usuario on usuario.id_user = noticias.idf_user
             where id_news <= $lastN and (LOWER(titulo) like LOWER('%" . $name . "%'))
             order by id_news DESC");
        } else {
            $stm = $conexao->conectar()->prepare("select * from noticias inner join usuario on usuario.id_user = noticias.idf_user 
            where id_news <= $lastN  order by id_news DESC ");
        }

        // if (isset($_POST["Inidate"]) && isset($_POST["Fimdate"])) {

        //     $dataIni = date('Y-m-d', strtotime(str_replace('/', '-', htmlspecialchars($_POST['Inidate']))));
        //     $dataFim = date('Y-m-d', strtotime(str_replace('/', '-', htmlspecialchars($_POST['Fimdate']))));

        //     $stm = $conexao->conectar()->prepare("select * from noticias inner join usuario on usuario.id_user = noticias.idf_user
        //     where id_news <= $lastN and post_day between '$dataIni' and '$dataFim' order by id_news DESC ");
        // }


        // else {
        //     $stm = $conexao->conectar()->prepare("select * from noticias inner join usuario on usuario.id_user = noticias.idf_user 
        //     where id_news <= $lastN  order by id_news DESC ");
        // }

        $stm->execute();

        while ($newsval = $stm->fetch(PDO::FETCH_OBJ)) {
            if ($i <= 4) {
                echo ('
                <div class="card news" id="' . $newsval->id_news . '">
                <img src="' . $newsval->news_image . '" class="card-img-top card-img">
                <div class="card-body" >
                <p class="card-text " style="text-align: center; margin-top: 30px;">' . $newsval->titulo  . '<br><br>' . $newsval->username . ' ' . $newsval->post_day . '</p>
                </div>
              </div>');
            }
            $i++;
        };
    } catch (Exception $e) {
        echo ($e);
    }
}

function news_situation()
{
    try {
        $conexao = new conexao_banco();
        $conexao->conectar();

        $stm = $conexao->conectar()
            ->prepare("update noticias set situação = :situacao where id_news = :id_news");

        $stm->bindParam("id_news", $_POST['news_id']);
        $stm->bindParam("situacao", $_POST['situacao']);
        $stm->execute();
    } catch (Exception $e) {
        echo ("<script>alert('Erro ao criar noticia')</script>");
        echo ($e);
    }
};
