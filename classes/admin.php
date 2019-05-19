<?php
class Admin extends User {
  private $admin;

  public function __construct($userID, $admin) {
    $this->$admin = $admin;
    parent::__construct($userID);
  }
  // Raderar filmer
  public function deleteFilm($conn, $id) {
    $query = "DELETE FROM film WHERE filmId=".$id;
    $result = mysqli_query($conn, $query) or die('query failed: '.$query);
    echo '<h2 class="warning"> Filmen har tagits bort! </h2>';
    return $result;
  }
  // Uppdaterar filmer
  public function updateFilm($conn, $id) {
    $title = mysqli_real_escape_string($conn, $_POST['titel']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $seats = mysqli_real_escape_string($conn, $_POST['seats']);
    $query = "UPDATE film set filmTitel= '$title', filmDate= '$date',
    filmPris='$price', platser='$seats' WHERE filmId='$id'";
    $result = mysqli_query($conn, $query) or die('query failed: '.$query);
    echo '<h2 class="warning"> Filmens info har uppdaterats!</h2>';
    return $result;
  }
}
 ?>
