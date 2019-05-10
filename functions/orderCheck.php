<?php
  function orderCheck($age,$choice, $guardian) {
    if ($choice > 7 && $age < 11 && $guardian == 'nej' || $choice > 11 && $age < 15 && $guardian == 'nej' || $choice > 11 && $age < 11 && $guardian == 'ja' ) {
      echo "<h4 class='warning'>Du är för ung för att köpa denna biljett!</h4>";
    } elseif ($choice > 7 && $choice <= 11 && $age < 11 && $guardian == 'ja') {
       return 'pass';
    } elseif ($choice > 11 && $age < 15 && $guardian == 'ja') {
       return 'pass';
    }
    else {
      return 'pass';
    }
  }
 ?>
