<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

if (!file_exists('vendor/autoload.php')) {
  die('Instale as dependencias');
}

require_once 'vendor/autoload.php';

if (empty($_GET)) {
  header('Location: ?path=inicio');
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Agenda</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/stylesheet.css">
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">  
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="assets/js/bootstrap-datepicker.js" type="text/javascript"></script>
</head>

<body>

  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Agenda</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" id="nav-link-areas" style="cursor: pointer;">Áreas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="nav-link-tarefas" style="cursor: pointer;">Tarefas</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="position-relative" style="margin-top: 20px">
    <?php
    if (empty($_GET['path']) || !isset($_GET['path'])) {
      die('<h3>ERRO - 404. Página não encontrada</h3>');
    } else if ($_GET['path'] != 'agenda' && $_GET['path'] != 'inicio'  && $_GET['path'] != 'area' && $_GET['path'] != 'tarefas') {
      header('Location: notfound.php');
    } else {
      if (!file_exists('views/' . $_GET['path'] . '.php')) {
        die('<h3>ERRO - 404. Página não encontrada</h3>');
      }
      try {
        require_once('views/' . $_GET['path'] . '.php');
      } catch (\Throwable $th) {
        header('Location: notfound.php');
      }
    }
    ?>

  </div>

  <script type="text/javascript">
    document.querySelector('#nav-link-areas').addEventListener('click', function(ev) {
      var qryString = '?path=area';
      location.href = qryString;
    });


    document.querySelector('#nav-link-tarefas').addEventListener('click', function(ev) {
      var qryString = '?path=tarefas';
      location.href = qryString;
    });

  </script>
</body>

</html>