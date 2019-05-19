
<?php
include 'header.php';
if(!isset($_SESSION['status'])) {
  header('Location:login.php');
  exit;
}
require './functions/conn.php';
require './classes/user.php';
$conn = dbConnect();
$kund = new User($_SESSION['kundId']);
// Hämtar array med önskad tabell från db
$result= $kund->getList($conn, 'film');?>

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

<?php if (isset($_POST['order']) && $_POST['order'] == 1) {
  $_SESSION['antal'] = $quantity;
  // Hämtar kund Id
  $userId = $_SESSION['kundId'];
  // Hämtar vald film via filmId
  $query = "SELECT * FROM film WHERE filmId='$choice'";
  $result = mysqli_query($conn, $query);
  while ($row= mysqli_fetch_array($result)) {
    // Kollar åldern
    $ageCheck =  orderCheck($age, $row['filmAge'], $guardian );
    if ($ageCheck == 'pass') {
      // utför ett köp av en biljett
      $kund->ticket($conn, $userId, $choice, $quantity);
      header('Location: kvitto.php');
    }
  }
}?>



<?php dbClose($conn);?>
<?php include 'footer.php'; ?>
