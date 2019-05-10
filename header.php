<?php session_start(); ?>

<!DOCTYPE html>
<html lang="sv" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Bio</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-dark bg-dark">
        <a href="index.php" class="navbar-brand dark">BioOnline</a>
        <?php if(!isset($_SESSION['status'])) : ?>
          <a class="login" href="login.php">Logga in</a>
       <?php else : ?>
         <?php if(isset($_SESSION['antal']) && $_SESSION['antal'] > 0) : ?>
           <a class="kassan" href="checkout.php">Kassan &#9873; (<?php echo $_SESSION['antal'];?>)</a>
         <?php endif; ?>
         <a class="logout" href="logout.php">Logga ut</a>
     <?php endif; ?>
      </nav>
    </header>