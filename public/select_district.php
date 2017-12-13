<?php
if(isset($_REQUEST['state'])){
  $state = $_REQUEST['state'];
  $con = pg_connect("host=localhost port=5432 dbname=jrms user=postgres password=123456") or die("Could not connect: " . pg_last_error());
  $sql = "SELECT * FROM country WHERE state=$state ORDER BY district";
  if($query = PG_QUERY($con, $sql))
  {
    while($result = PG_FETCH_ARRAY($query))
    {
      echo '<option value="'.$result['id'].'">'.$result['district'].'</option>';
    }
  }
  else
  {
    //echo '<option value="" selected disabled> --- Select Sub-Category --- </option>';
    echo '<option value="" selected disabled> --- Select --- </option>';
  }
}
?>
