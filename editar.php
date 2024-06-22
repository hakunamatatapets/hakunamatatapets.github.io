<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Perfil - HAKUNA MATATA PETS</title>
  <link rel="stylesheet" href="CSS/style_perfil.css" />
  <link rel="stylesheet" href="CSS/style_base.css" />
  <link rel="stylesheet" href="CSS/estilo_board.css">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
</head>

  <?php include 'template/header.php'?>

  <?php include 'PHP/editar.php' ?>

  <?php include 'template/footer.php'?>