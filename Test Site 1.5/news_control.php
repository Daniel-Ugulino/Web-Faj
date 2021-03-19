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
      <h5 class="User-text">Sla quem 10/10/2021</h5>
      <a href="create-news.php"><button type="button" class=CreateNews>Novo</button></a>
    </nav>
  </nav>

  <div class="container-fluid">
    <div class="row d-flex justify-content-center">
      <p class="Control-Title">Controle de Noticias</p>
    </div>
    <div class="row d-flex justify-content-center" style="margin-top: 20px;">
      <input type="text" class="input-tags" placeholder="Titulo da Noticia">
      <input type='text' class="input-tags" disabled placeholder="Data de Publicação" id="text">
      <input type="date" id="sla1" onchange="data()" style="width: 0.1px; height: 0.1px; opacity: 0;">
      <label for="sla1">
        <img src="Arquivos\Icones\calendar.svg" class="svg" alt="">
      </label>
    </div>
    <div class="row d-flex justify-content-center" style="margin-top:30px">

      <div class="card" id="3">
        <img src="Arquivos/Icones/emgepron-logo-2.png" class="card-img-top">
        <div class="card-body">
          <p style="text-align: center;">Titulo</p>
          <p class="card-text" style="text-decoration: none;">
            aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
          <div>
            <p style="text-align: center;"> Daniel Fonseca 2/2/2021</p>
          </div>
        </div>
      </div>


      <div class="card" id="3">
        <img src="Arquivos/Icones/emgepron-logo-2.png" class="card-img-top">
        <div class="card-body">
          <p style="text-align: center;">Titulo</p>
          <p class="card-text" style="text-decoration: none;">
            aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
          <div>
            <p style="text-align: center;"> Daniel Fonseca 2/2/2021</p>
          </div>
        </div>
      </div>

      <div class="card" id="3">
        <img src="Arquivos/Icones/emgepron-logo-2.png" class="card-img-top">
        <div class="card-body">
          <p style="text-align: center;">Titulo</p>
          <p class="card-text" style="text-decoration: none;">
            aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
          <div>
            <p style="text-align: center;"> Daniel Fonseca 2/2/2021</p>
          </div>
        </div>
      </div>

      <div class="card" id="3">
        <img src="Arquivos/Icones/emgepron-logo-2.png" class="card-img-top">
        <div class="card-body">
          <p style="text-align: center;">Titulo</p>
          <p class="card-text" style="text-decoration: none;">
            aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
          <div>
            <p style="text-align: center;"> Daniel Fonseca 2/2/2021 </p>
          </div>
        </div>
      </div>

      <div class="card" id="3">
        <img src="Arquivos/Icones/emgepron-logo-2.png" class="card-img-top">
        <div class="card-body">
          <p style="text-align: center;">Titulo</p>
          <p class="card-text" style="text-decoration: none;">
            aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
          <div>
            <p style="text-align: center;"> Daniel Fonseca 2/2/2021</p>
          </div>
        </div>
      </div>

      <div class="card" id="3">
        <img src="Arquivos/Icones/emgepron-logo-2.png" class="card-img-top">
        <div class="card-body">
          <p style="text-align: center;">Titulo</p>
          <p class="card-text" style="text-decoration: none;">
            aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
          <div>
            <p style="text-align: center;"> Daniel Fonseca 2/2/2021</p>
          </div>
        </div>
      </div>

    </div>
    <nav class="d-flex justify-content-center" style="margin-top:55px;">
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

  <script>
    $(document).ready(function() {
      $('#datepicker').datepicker();
    });

    function data() {
      x = document.getElementById("sla1").value;
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
  <script src="javascript/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js"></script>
  <script src="javascript/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.pt-BR.min.js"></script>
</body>

</html>