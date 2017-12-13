<?php
if(isset($_REQUEST['categoryCode'])){
  $categoryCode = $_REQUEST['categoryCode'];
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
    // echo '<script language="javascript">alert("Error 2")</script>';
    echo '<option value="" selected disabled> --- Select Sub-Category --- </option>';
  }
}
?>
