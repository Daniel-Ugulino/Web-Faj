<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="javascript\css\bootstrap.css">
  <title>FAJ-Noticia</title>
  <link rel="stylesheet" href="css\news.css">
  <link rel="stylesheet" href="css\public.css">
</head>

<body>

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

    <nav class="nav-login">
      <form action="sla.php" method="POST" style="display:flex;">
        <div style="display:flex; margin-top: 5px;">
          <input type="text" id="username" style="border-radius: 7px 0 0 7px;" class="form-control" name="Usuario"
            placeholder="Usuario">
          <input type="text" id="key" name="senha" style="border-radius: 0 7px 7px 0; margin-right: 20px;"
            class="form-control" placeholder="Senha">
          <button type="submit" id="sub" hidden disabled></button>
        </div>
        <label for="sub">
          <svg aria-hidden="true" data-prefix="far" data-icon="caret-square-right" style="margin-top: 6.5px;"
            class="svg-inline--fa fa-caret-square-right fa-w-14" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 448 512">
            <path
              d="M176 354.9V157.1c0-10.7 13-16.1 20.5-8.5l98.3 98.9c4.7 4.7 4.7 12.2 0 16.9l-98.3 98.9c-7.5 7.7-20.5 2.3-20.5-8.4zM448 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48zm-48 346V86c0-3.3-2.7-6-6-6H54c-3.3 0-6 2.7-6 6v340c0 3.3 2.7 6 6 6h340c3.3 0 6-2.7 6-6z">
            </path>
          </svg>
        </label>
      </form>
    </nav>
  </nav>

  <div class="container-fluid" id="News_content">

  </div>

  <script src="javascript/sidebar.js"></script>
  <script src="javascript/jquery-3.5.1.min.js"></script>
  <script src="javascript/js/bootstrap.min.js"></script>
  <script src="javascript/posts.js"></script>

</body>

</html>