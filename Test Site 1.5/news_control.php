<?php
session_start();
$user = $_SESSION['name_user'];
$logged_user = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Noticias</title>
  <link rel="stylesheet" href="css/public.css">
  <link rel="stylesheet" href="javascript/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/news-control.css">
  <link rel="stylesheet" href="javascript\jquery-ui-1.12.1.custom\jquery-ui.css">
</head>

<body>
  <nav class="navbar sticky-top" id="navbar">
    <nav>
      <svg aria-hidden="true" data-prefix="fas" data-icon="bars" onclick="ActiveSidebar()" class="svg-inline--fa fa-bars fa-w-14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
        <path d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z">
        </path>
      </svg>
      <a href="index.php"> <img src="Arquivos/Icones/emgepron-logo-2.png" style="margin-left: 20px;"></a>
    </nav>
    <nav style="display: flex;">
      <h5 class="User-text"><?= $user ?></h5>
      <a href="create-news.php"><button type="button" class=CreateNews>Novo</button></a>
    </nav>
  </nav>

  <div class="container-fluid">
    <div class="row d-flex justify-content-center">
      <p class="Control-Title">Controle de Noticias</p>
    </div>
    <div class="row d-flex justify-content-center" style="margin-top: 20px;" id="news_filter">

      <input type="text" class="input-tags" id="name_filter" placeholder="Titulo da Noticia">
      <!-- <input type='text' class="input-tags" placeholder="De:" id="start_date">
      <input type='text' class="input-tags" placeholder="Até:" id="end_date"> -->


    </div>

    <div class="row d-flex justify-content-center" id="card_control" style="margin-top:30px">

      <div class="d-flex justify-content-center">
        <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>

    </div>
    <nav class="d-flex justify-content-center" style="margin-top:55px;">
      <ul class="pagination hide">
        <li class="page-item"><a class="page-link" id="0">1</a></li>
        <li class="page-item"><a class="page-link" id="5">2</a></li>
        <li class="page-item"><a class="page-link" id="10">3</a></li>
        <li class="page-item"><a class="page-link" id="15">4</a></li>
        <li class="page-item"><a class="page-link" id="20">5</a></li>
        <li class="page-item"><a class="page-link" id="25">6</a></li>
        <li class="page-item"><a class="page-link" id="30">7</a></li>
        <li class="page-item"><a class="page-link" id="35">8</a></li>
        <li class="page-item"><a class="page-link " id="40">9</a></li>
        <li class="page-item"><a class="page-link" id="45">10</a></li>
      </ul>
    </nav>
  </div>



  <script src="javascript/sidebar.js"></script>
  <script src="javascript/jquery-3.5.1.min.js"></script>
  <script src="javascript/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
  <script src="javascript/js/bootstrap.min.js"></script>
  <script src="javascript/posts.js"></script>

  <script>
    sessionStorage.setItem('user', <?=$logged_user?>);

    $(function() {
      $("#start_date").datepicker();
      $("#end_date").datepicker();
    });
  </script>



  <script>
    function data() {
      x = document.getElementById("date_filter").value;
      y = document.getElementById("text");
      if (x == "") {
        y.setAttribute("placeholder", "Data de Publicação")
      }
      y.setAttribute("placeholder", x);
      console.log(x, y.setAttribute("value", x));
    }
  </script>
</body>

</html>