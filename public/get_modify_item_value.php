<?php
  if(isset($_REQUEST['idetail'])) {
    $idetail = $_REQUEST['idetail'];
    $con = pg_connect("host=localhost port=5432 dbname=jrms user=postgres password=123456") or die("Could not connect: " . pg_last_error());
    $sql = "SELECT * FROM items WHERE bnumber='$idetail' OR itemname='$idetail'";
    if($query = PG_QUERY($con, $sql))
    {
      while($result = PG_FETCH_ARRAY($query))
      {
        $bnumber = $result['bnumber'];
        $itemname = $result['itemname'];
        $openstock = $result['openstock'];
        $minstock = $result['minstock'];
        $isactive = $result['isactive'];
        $notforsale = $result['notforsale'];
        $ispurchased = $result['ispurchased'];
        $online = $result['online'];
        $categoryname = $result['categoryname'];
        $subcategoryname = $result['subcategoryname'];
        $desc = $result['desc'];
        $featured_image = $result['featured_image'];
        $mrp = $result['mrp'];
        $disc1 = $result['disc1'];
        $disc2 = $result['disc2'];
        $discvalue = $result['discvalue'];
        $finalprice = $result['finalprice'];
        $finalvalue = $bnumber.'%'.$itemname.'%'.$openstock.'%'.$minstock.'%'.$isactive.'%'.$notforsale.'%'.$ispurchased.'%'.$online.'%'.
        $categoryname.'%'.$subcategoryname.'%'.$desc.'%'.$featured_image.'%'.$mrp.'%'.$disc1.'%'.$disc2.'%'.$discvalue.'%'.$finalprice;
        echo $finalvalue;
      }
    }
    else
    {
      echo '<script language="javascript">alert("Error in Connection")</script>';
    }
  }
?>
