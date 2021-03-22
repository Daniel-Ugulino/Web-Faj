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
  <link rel="stylesheet" type='text/css' href="javascript/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.css">

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
      <h5 class="User-text"><?=$user?></h5>
      <a href="create-news.php"><button type="button" class=CreateNews>Novo</button></a>
    </nav>
  </nav>

  <div class="container-fluid">
    <div class="row d-flex justify-content-center">
      <p class="Control-Title">Controle de Noticias</p>
    </div>
    <div class="row d-flex justify-content-center" style="margin-top: 20px;" id="news_filter">

      <input type="text" class="input-tags" id="name_filter" placeholder="Titulo da Noticia">
      <input type='text' class="input-tags" disabled placeholder="Data de Publicação" id="text">
      <input type="date" id="date_filter" onchange="data()" style="width: 0.1px; height: 0.1px; opacity: 0;">

      <label for="date_filter">
        <?xml version="1.0" encoding="iso-8859-1"?>
        <!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
          <g>
            <g>
              <path d="M452,40h-24V0h-40v40H124V0H84v40H60C26.916,40,0,66.916,0,100v352c0,33.084,26.916,60,60,60h392
			c33.084,0,60-26.916,60-60V100C512,66.916,485.084,40,452,40z M472,452c0,11.028-8.972,20-20,20H60c-11.028,0-20-8.972-20-20V188
			h432V452z M472,148H40v-48c0-11.028,8.972-20,20-20h24v40h40V80h264v40h40V80h24c11.028,0,20,8.972,20,20V148z" />
            </g>
          </g>
          <g>
            <g>
              <rect x="76" y="230" width="40" height="40" />
            </g>
          </g>
          <g>
            <g>
              <rect x="156" y="230" width="40" height="40" />
            </g>
          </g>
          <g>
            <g>
              <rect x="236" y="230" width="40" height="40" />
            </g>
          </g>
          <g>
            <g>
              <rect x="316" y="230" width="40" height="40" />
            </g>
          </g>
          <g>
            <g>
              <rect x="396" y="230" width="40" height="40" />
            </g>
          </g>
          <g>
            <g>
              <rect x="76" y="310" width="40" height="40" />
            </g>
          </g>
          <g>
            <g>
              <rect x="156" y="310" width="40" height="40" />
            </g>
          </g>
          <g>
            <g>
              <rect x="236" y="310" width="40" height="40" />
            </g>
          </g>
          <g>
            <g>
              <rect x="316" y="310" width="40" height="40" />
            </g>
          </g>
          <g>
            <g>
              <rect x="76" y="390" width="40" height="40" />
            </g>
          </g>
          <g>
            <g>
              <rect x="156" y="390" width="40" height="40" />
            </g>
          </g>
          <g>
            <g>
              <rect x="236" y="390" width="40" height="40" />
            </g>
          </g>
          <g>
            <g>
              <rect x="316" y="390" width="40" height="40" />
            </g>
          </g>
          <g>
            <g>
              <rect x="396" y="310" width="40" height="40" />
            </g>
          </g>
        </svg>

      </label>

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

  <script src="javascript/sidebar.js"></script>
  <script src="javascript/jquery-3.5.1.min.js"></script>
  <script src="javascript/js/bootstrap.min.js"></script>
  <script src="javascript/posts.js"></script>

  
  </body>

</html>