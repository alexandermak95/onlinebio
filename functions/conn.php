<?php
function dbConnect()
{
  $user = 'root';
  $pass = 'root';
  $host = 'localhost';
  $db= 'labb2';
  $conn = mysqli_connect($host,$user,$pass,$db)
  or die('Kunde inte ansluta till db');
  mysqli_select_db($conn, 'labb2') or die('kunde inte hitta db');
  return $conn;
}

function dbClose($conn) {
  mysqli_close($conn);
}
 ?>
