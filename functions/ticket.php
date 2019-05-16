<?php
function ticket($conn, $userId, $filmId, $antal) {
  //Lägger till biljett i ticket tabellen
  $userId1 = mysqli_real_escape_string($conn, $userId);
  $filmId1 = mysqli_real_escape_string($conn, $filmId);
  $antal1 = mysqli_real_escape_string($conn, $antal);
  $query = "INSERT INTO ticket (ticketKundId,ticketFilmId,antalTickets) VALUES((SELECT kundId FROM kund WHERE kundId=$userId1), (SELECT filmId FROM film WHERE filmId=$filmId1), $antal1 )";
  $result = mysqli_query($conn,$query) or die("Query failed: $query");

  // Uppdaterar film tabellen
  $current = "SELECT platser FROM film WHERE filmId=$filmId1";
  $curr = mysqli_query($conn, $current) or die("Query failed: $query");
  $row = mysqli_fetch_array($curr);
  // Kollar att önskad antal biljetter inte är större än antal platser
  if($antal1 > $row[0]) {
    die("<h2 class='warning'> Det finns inte såpass många biljetter kvar!</h2>");
  }else {
    $query2 = "UPDATE film SET platser= $row[0]-$antal WHERE filmId=$filmId1";
    $result2 = mysqli_query($conn,$query2);
  }
  return $result;
}
 ?>
