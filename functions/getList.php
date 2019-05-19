<?php
function getList($conn, $nyckel) {
  $query = "SELECT * FROM $nyckel";
  $result = mysqli_query($conn, $query);
  return $result;
}


function getSpec($conn, $id) {
  $query = "SELECT * FROM film
  INNER JOIN ticket ON ticket.ticketKundId =$id and ticket.ticketFilmId= film.filmId";
  $result = mysqli_query($conn,$query) or die('Query failed:'. $query);
  return $result;
}
 ?>
