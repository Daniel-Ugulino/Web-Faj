<?php
	session_start();
  $y = 0;
  foreach ($_SESSION['noticia-menu'] as $noticias)
  {   
      $id[$y] = $noticias[0];
      $titulo[$y] = $noticias[1];
      $subtitulo[$y] = $noticias[2];
      $img[$y] = $noticias[3];
      $y++;
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAJ-Emgeprom</title>
  <link rel="stylesheet" href="javascript/css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/public.css">
</head>

<body id="noticia" >

  <nav class="navbar sticky-top" id="navbar">
    <nav>
      <svg aria-hidden="true" data-prefix="fas" data-icon="bars" onclick="ActiveSidebar()"
        class="svg-inline--fa fa-bars fa-w-14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
        <path
          d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z">
        </path>
      </svg>

      <img src="Arquivos/Icones/emgepron-logo-2.png" style="margin-left: 20px;">
    </nav>

    <nav class="nav-login">

      <form id="login" style="display:flex;">
        <div style="display:flex; margin-top: 5px;">

          <input type="text" id="username" style="border-radius: 7px 0 0 7px;" class="form-control" name="Usuario"
            placeholder="Usuario">
          <input type="password" id="key" style="border-radius: 0 7px 7px 0; margin-right: 20px;"
            class="form-control" placeholder="Senha">
          <button id="sub" hidden type="submit"></button>
        </div>
        <label for="sub">
          <svg aria-hidden="true" data-prefix="far" data-icon="caret-square-right" style="margin-top: 6.5px;"
            class="svg-inline--fa fa-caret-square-right fa-w-14" viewBox="0 0 448 512">
            <path
              d="M176 354.9V157.1c0-10.7 13-16.1 20.5-8.5l98.3 98.9c4.7 4.7 4.7 12.2 0 16.9l-98.3 98.9c-7.5 7.7-20.5 2.3-20.5-8.4zM448 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48zm-48 346V86c0-3.3-2.7-6-6-6H54c-3.3 0-6 2.7-6 6v340c0 3.3 2.7 6 6 6h340c3.3 0 6-2.7 6-6z">
            </path>
          </svg>
        </label>
      </form>

    </nav>

  </nav>

  <div class="container-fluid" >

    <!--News Header-->
    <div class="row d-flex justify-content-center">
      <img src="Arquivos/Icones/FAJCMC-Sem-fundo.png" alt="" class="Logo-Faj">
      <p class="News-Header">Noticias Principais</p>
    </div>

    <!--Carrousel News-->
    <div class="row d-flex justify-content-center">
      <div id="MainNews" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#MainNews" data-slide-to="0" class="active"></li>
          <li data-target="#MainNews" data-slide-to="1"></li>
          <li data-target="#MainNews" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner">

          <div class="carousel-item active justify-content-center" id="<?=$news[0][0]?>">
            <div class="News justify-content-center">
              <div class="slide-text">
                <h5 style="font-weight: bold;"><?=$titulo[0]?></h5>
                <p><?=$subtitulo[0]?></p>
              </div>
              <img src="<?=$img[0]?>">
            </div>
          </div>

          <div class="carousel-item" id="<?=$id[1]?>">
            <div class="News justify-content-center">
              <div class="slide-text">
                <h5 style="font-weight: bold;"><?=$titulo[1]?></h5>
                <p><?=$subtitulo[1]?></p>
              </div>
              <img src="<?=$img[1]?>">
            </div>
          </div>

          <div class="carousel-item" id="<?=$id[2]?>">
            <div class="News justify-content-center">
              <div class="slide-text">
                <h5 style="font-weight: bold;"><?=$titulo[2]?></h5>
                <p><?=$subtitulo[2]?></p>
              </div>
              <img src="<?=$img[2]?>">
            </div>
          </div>

        </div>
      </div>
    </div>
    <!--Cards News-->
    <form action="sla.php" method="POST" id="cardForm">
      <div class="row d-flex justify-content-center">

        <div class="card" id="<?=$id[3]?>" style="height: 225px;">
          <img src="<?=$img[3]?>" class="card-img-top">
          <div class="card-body">
            <p class="card-text" style="text-decoration: none;">
              <?=$subtitulo[3]?></p>
          </div>
        </div>

        <div class="card" id="<?=$id[4]?>" style="height: 225px;">
          <img src="<?=$img[4]?>" class="card-img-top">
          <div class="card-body">
            <p class="card-text" style="text-decoration: none;"><?=$subtitulo[4]?></p>
          </div>
        </div>

        <div class="card" id="<?=$id[5]?>" style="height: 225px;">
          <img src="<?=$img[5]?>" class="card-img-top">
          <div class="card-body">
            <p class="card-text" style="text-decoration: none;"><?=$subtitulo[5]?>s</p>
          </div>
        </div>

        <div class="card" id="<?=$id[6]?>" style="height: 225px;">
          <img src="<?=$img[6]?>" class="card-img-top">
          <div class="card-body">
            <p class="card-text" style="text-decoration: none;"><?=$subtitulo[6]?></p>
          </div>
        </div>

      </div>
    </form>
    <!--Cards News Pagination-->
    <nav class="d-flex justify-content-center" style="margin-top:10px">
      <ul class="pagination">
        <li class="page-item"><a class="page-link">1</a></li>
        <li class="page-item"><a class="page-link">2</a></li>
        <li class="page-item"><a class="page-link">3</a></li>
        <li class="page-item"><a class="page-link">4</a></li>
        <li class="page-item"><a class="page-link">5</a></li>
        <li class="page-item"><a class="page-link">6</a></li>
        <li class="page-item"><a class="page-link">7</a></li>
        <li class="page-item"><a class="page-link">8</a></li>
        <li class="page-item"><a class="page-link">9</a></li>
        <li class="page-item"><a class="page-link">10</a></li>
      </ul>
    </nav>
  </div>

  <script src="javascript/sidebar.js"></script>
  <script src="javascript/jquery-3.5.1.min.js"></script>
  <script src="javascript/js/bootstrap.min.js"></script>
  <script src="javascript/posts.js"></script>

</body>

</html>