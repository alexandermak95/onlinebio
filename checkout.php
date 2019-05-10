<?php include 'header.php';?>
<!-- Kollar inloggningen -->
<?php if(!isset($_SESSION['status'])) {
  header('Location:login.php');
  exit;
} ?>
<?php $antal = $_SESSION['antal'];?>
<?php require './functions/counter.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-md-9 card checkout">
      <h2>Kassan</h2>
      Antal biljetter: <?php echo $antal;?>  <a class="remove" href="./templates/remove.php">X</a>
      <hr>
      Att betala = <?php echo counter($antal); ?> kr
    </div>
  </div>
  <div class="row">
    <div class="col-md-10">
      <a class="pay" href="kvitto.php">Bekräfta & beställ</a>
    </div>
  </div>
</div>


<?php include 'footer.php';?>
