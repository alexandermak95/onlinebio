<?php include 'header.php'; ?>

<!-- Kollar inloggningen -->
<?php if(!isset($_SESSION['status'])) {
  header('Location:login.php');
  exit;
} ?>
<!-- Hämtar alla filmer -->
<?php $filmer = $_SESSION['movies'];?>
<!-- Hämtar formuläret -->
<?php require './templates/booking-form.php'; ?>

<!-- Hämtar relevanta funktioner -->
<?php require './functions/orderCheck.php'; ?>
<!-- Hämtar values från formuläret -->
<?php
$age = $_POST['age'];
$choice = $_POST['val'];
$quantity = $_POST['antal'];
$guardian = $_POST['co'];
 ?>

<!-- Validator -->
<?php if (isset($_POST['order']) && $_POST['order'] == 1) {
  $_SESSION['antal'] = $quantity;
  $ageCheck =  orderCheck($age, $choice, $guardian );
  if ($ageCheck == 'pass') {
    header('Location: checkout.php');
  }
}?>


<?php include 'footer.php'; ?>
