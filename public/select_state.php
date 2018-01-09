<?php
  if(isset($_REQUEST['Country']))
  {
    $Country = $_REQUEST['Country'];
    echo $Country;
  }
  else
  {
    echo "error";
  }
?>
