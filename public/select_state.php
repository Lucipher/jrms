<?php
  if(isset($_REQUEST['Country']))
  {
    $Country = $_REQUEST['Country'];
    echo $Country;
    // $con = pg_connect("host=localhost port=5433 dbname=jrms user=postgres password=123456") or die("Could not connect: " . pg_last_error());
    // $sql = "SELECT * FROM country WHERE country='INDIA'";
    // if($query = PG_QUERY($con, $sql))
    // {
    //   while($result = PG_FETCH_ARRAY($query))
    //   {
    //     echo '<option value="'.$result['id'].'">'.$result['state'].'</option>';
    //     //echo $Country;
    //   }
    // }
    // else
    // {
    //   echo '<option value="" selected disabled> --- Select --- </option>';
    // }
  }
  else
  {
    echo "error";
  }
?>
