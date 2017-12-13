<?php
// if(isset($_REQUEST['search_text'])) {
//
//   $search_text = $_REQUEST['search_text'];
  $con = pg_connect("host=localhost port=5432 dbname=jrms user=postgres password=123456") or die("Could not connect: " . pg_last_error());
  $request = pg_escape_string($con, $_POST["search_text"]);
  $sql = "SELECT * FROM items WHERE itemname LIKE '%".$request."%'";
  // $json = array();
  // if($query = PG_QUERY($con, $sql))
  // {
  //   echo "Test1";
  //   while($result = PG_FETCH_ARRAY($query))
  //   {
  //     $json[] = array(
  //     'item_values' => $result['itemname']);
  //     echo json_encode($item_values);
  //   }
  // }
  $result = pg_query($con, $sql);
  $data = array();
  if(pg_num_rows($result) > 0)
  {
    while($row = pg_fetch_assoc($result))
    {
      $data[] = $row["itemname"];
    }
    echo json_encode($data);
  }
// }
// else
// {
//   echo "Error in retriving item details";
// }
?>
