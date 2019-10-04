<?php
include '../topmenu.php';
include '../sidebar.php';
include '../db/koneksi.php';

error_reporting(0);

  switch($_GET['page']){
      default:
        include "dashboard.php";
        break;
  }



?>


<?php
include '../footer.php';

?>