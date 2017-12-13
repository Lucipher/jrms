<?php
$con = pg_connect("host=localhost port=5432 dbname=jrms user=postgres password=123456") or die("Could not connect: " . pg_last_error());
$sql = "SELECT * FROM categories";
if($query = PG_QUERY($con, $sql))
{
  $i = 0;
  $category_values = [];
  while($result = PG_FETCH_ARRAY($query))
  {
    $category_values[$i] = '<option value="'.$result[0].'">'.$result[1].'</option>';
    //$category_values[i] = "asa";
    echo $category_values[$i];
    echo "%";
    $i++;
  }
}
else {
  echo "Error";
}
?>
