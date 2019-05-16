<?php
function getList($conn, $nyckel) {
  $query = "SELECT * FROM $nyckel";
  $result = mysqli_query($conn, $query);
  return $result;
}
 ?>
