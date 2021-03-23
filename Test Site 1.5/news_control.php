<?php
session_start();
$user = $_SESSION['name_user']
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
      <a href="main.php"> <img src="Arquivos/Icones/emgepron-logo-2.png" style="margin-left: 20px;"></a>
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
      <input type='text' class="input-tags" placeholder="Data Inicial" id="start_date">
      <input type='text' class="input-tags" placeholder="Data Final" id="end_date">


    </div>

    <div class="row d-flex justify-content-center" id="card_control" style="margin-top:30px">


    </div>
    <nav class="d-flex justify-content-center" style="margin-top:55px;">
      <ul class="pagination hide">
        <li class="page-item"><a class="page-link" id="3">1</a></li>
        <li class="page-item"><a class="page-link" id="6">2</a></li>
        <li class="page-item"><a class="page-link" id="9">3</a></li>
        <li class="page-item"><a class="page-link" id="12">4</a></li>
        <li class="page-item"><a class="page-link" id="15">5</a></li>
        <li class="page-item"><a class="page-link" id="18">6</a></li>
        <li class="page-item"><a class="page-link" id="21">7</a></li>
        <li class="page-item"><a class="page-link" id="24">8</a></li>
        <li class="page-item"><a class="page-link " id="27">9</a></li>
        <li class="page-item"><a class="page-link" id="30">10</a></li>
      </ul>
    </nav>
  </div>



  <script src="javascript/sidebar.js"></script>
  <script src="javascript/jquery-3.5.1.min.js"></script>
  <script src="javascript/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
  <script src="javascript/js/bootstrap.min.js"></script>
  <script src="javascript/posts.js"></script>

  <script>
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