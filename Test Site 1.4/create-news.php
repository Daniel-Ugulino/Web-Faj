<?php
	session_start();
  $_SESSION['op'] = 'news-create';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="javascript\css\bootstrap.css">
  <title>Criação da Noticia</title>
  <link rel="stylesheet" href="css\public.css">
  <link rel="stylesheet" href="css\create_news.css">
</head>

<body>
  <form enctype="multipart/form-data" id="cadastrar">

    <nav class="navbar sticky-top" id="navbar">
      <nav>
        <svg aria-hidden="true" data-prefix="fas" data-icon="bars" onclick="ActiveSidebar()"
          class="svg-inline--fa fa-bars fa-w-14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
          <path
            d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z">
          </path>
        </svg>
        <a href="main.php"> <img src="Arquivos/Icones/emgepron-logo-2.png" style="margin-left: 20px;"></a>
      </nav>
      <nav style="display: flex;">
        <h5 class="User-text" id="date">Sla quem </h5>
        <button type="submit" class=publicarN name="submit">Publicar</button>
      </nav>
    </nav>

    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="Cn-Cabeçalho">
          <input type="text" name="Titulo" placeholder="Titulo" class="titulo-input" id="titulo" required
            maxlength="27">
          <input type="text" name="Stitulo" placeholder="Sub-Titulo" class="Stitulo-input" id="Stitulo" required
            maxlength="70">
          <input type="file" name="file" id="news-file" class="inputfile" onchange="File_Name()">

          <label for="news-file" class="file-input" id="filelabel" style="overflow: hidden;">Anexar Arquivos</label>

        </div>
      </div>

      <div class="row d-flex justify-content-center">

        <div class="img-input-box d-flex justify-content-center" id="img-preview" onclick="deletes()">

          <input type="file" accept="image/*" id="news-image" required class="inputfile" onchange="preview()"
            name="images">
          <label for="news-image" class="Nimg" id="Nimg">Selecionar Imagem</label>
          <img src="" alt="" id="previews" class="preview-img" style="display: none;">

        </div>

        <textarea name="p1noticia" id="p1noticia" cols="30" rows="10" wrap="hard" class="p_noticia1" maxlength="1180"
          placeholder="Escreva o texto aqui. Máximo de :1180 caracteres" required></textarea>

      </div>
      <div class="row justify-content-center">

        <textarea name="p2noticia" id="p2noticia" cols="30" rows="10" wrap="hard" class="p_noticia2" maxlength="740"
          placeholder="Escreva o texto aqui. Máximo de :740 caracteres"></textarea>
      </div>

      <div class="row justify-content-center">
        <img src="Arquivos\Icones\FAJCMC-Sem-fundo.png" alt="" class="Logo-Faj">
      </div>
    </div>

  </form>

  <script src="javascript/files-preview.js"></script>
  <script src="javascript/img-preload.js"></script>
  <script src="javascript/sidebar.js"></script>
  <script src="javascript/jquery-3.5.1.min.js"></script>


  <script>
    window.onload = function () {
      var $dia = document.getElementById("date");
      var $sla = new Date();
      $dia.innerText = $sla.getDate() + "/" + $sla.getMonth() + "/" + $sla.getFullYear();;
    };
  </script>

  <script src="javascript/js/bootstrap.min.js"></script>
  <script src="javascript/posts.js"></script>
  <script>

    // $(document).ready(function(){
    //     $("#cadastrar").on("submit", function(event){
    //         event.preventDefault();

    //         var formValues= $(this).serialize();
    //         console.log(formValues);
    //         $.post("php/functions.php", formValues, function(data){
    //             // Display the returned data in browser
    //             $("#result").html(data);
    //         });
    //     });
    // });

  </script>
</body>

</html>