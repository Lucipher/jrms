<?php
if(isset($_REQUEST['categoryCode'])){
  $categoryCode = $_REQUEST['categoryCode'];
  echo $categoryCode;
  $categoryCode = substr($categoryCode,-1);
  $con = pg_connect("host=localhost port=5432 dbname=jrms user=postgres password=123456") or die("Could not connect: " . pg_last_error());
  $sql = "SELECT * FROM subcategories WHERE category_id=$categoryCode ORDER BY subcategory";
  if($query = PG_QUERY($con, $sql))
  {
    while($result = PG_FETCH_ARRAY($query))
    {
      echo '<option value="'.$result['category_id'].'">'.$result['subcategory'].'</option>';
    }
  }
  else
  {
    //echo '<option value="" selected disabled> --- Select Sub-Category --- </option>';
    echo '<option value="" selected disabled> --- Select --- </option>';
  }
}
?>
