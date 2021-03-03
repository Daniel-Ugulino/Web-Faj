<?php
session_start();
$_SESSION['op'] = "news-select";
?>

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
      <a href="main.html"> <img src="Arquivos/Icones/emgepron-logo-2.png" style="margin-left: 20px;"></a>
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

  <div class="container-fluid">
    <div class="Cabeçalho">
      <h2>Titulo</h2>
      <h5>Sla quem 10/10/2010</h5>
    </div>
    <div class="row d-flex justify-content-center">
      <img src="Arquivos\Imagens\as1.jpeg" alt="" class="news-img w-100">
      <p class="news-paragraph1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, quibusdam
        veritatis.
        Repellendus tenetur, possimus praesentium porro repudiandae harum eum sequi aliquam odio amet, maxime
        explicabo! Eligendi, sapiente? Atque, non dicta!Lore Lorem ipsum dolor sit amet consectetur adipisicing elit.
        Ad, praesentium nesciunt deleniti, ipsum natus facere fugit sit alias, temporibus sunt quod cumque. A ipsum
        quaerat ad numquam. Eligendi, inventore. Et! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde
        impedit fugit consectetur quis perferendis velit aperiam, nostrum perspiciatis quidem nisi. Dolorem mollitia
        sunt quisquam facere consectetur ratione impedit dicta autem. Lorem ipsum dolor sit, amet consectetur
        adipisicing elit. Illum, in delectus. Vitae rem accusantium quod asperiores. Corporis autem ab voluptatem eos
        repudiandae obcaecati tempora vitae provident rerum. Eum, nisi sapiente? Lorem ipsum dolor sit amet
        consectetur adipisicing elit. Laborum magnam obcaecati quod ipsam qui voluptate odio earum dolore corporis?
        Tempora aspernatur a tempore? Reiciendis fugit adipisci eveniet veniam ad quasi! Lorem ipsum dolor sit amet
        consectetur adipisicing elit. Consectetur praesentium, veniam, vel non cumque magnam rerum iure id a possimus
        molestias, esse ipsum sapiente nulla alias quisquam dicta maxime. Quibusdam. Lorem ipsum dolor sit amet
        consectetur, adipisicing elit. Expedita a odit, qui perferendis ad quisquam</p>
    </div>
    <div class="row justify-content-center">
      <p class="news-paragraph2" data-toggle="popover" data-content="Disabled popover">Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia blanditiis quia et
        impedit atque ipsa sunt,
        natus aperiam assumenda ab voluptas culpa repellat cupiditate consectetur saepe veritatis tenetur quas nisi!
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur saepe necessitatibus quas doloremque.
        Suscipit in beatae aliquid, assumenda nobis saepe culpa officiis illo. Tempore nemo sint quasi, corporis sit ab?
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga soluta delectus harum explicabo debitis?
        Praesentium temporibus ex aliquid ab eveniet, aliquam, hic, accusamus expedita voluptas vitae beatae pariatur
        animi! Explicabo?Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, architecto, laboriosam
        velit, tenetur nihil laborum perspiciatis voluptatem doloremque similique omnis non cumque? Reiciendis commodi
        officia soluta explicabo veritatis expedita impedit!</p>
    </div>
    <div class="row justify-content-center">
      <img src="Arquivos\Icones\FAJCMC-Sem-fundo.png" alt="" class="Logo-Faj">
    </div>
  </div>

  <script src="javascript/sidebar.js"></script>
  <script src="javascript/jquery-3.5.1.min.js"></script>
  <script src="javascript/js/bootstrap.min.js"></script>
</body>

</html>