<!-- Use the returned data from the file datafromSQL and prepare it to be used by Chart.js  -->

<?php
  include_once('datafromSQL.php');
  $priceHist = $priceHistory();
  $price = array();
  $timestamp = array();
  foreach($priceHist as $priceHist) {
    $price[] = $priceHist['price'];
    $timestamp[] = $priceHist['timestamp'];
  }
  $price = json_encode($price);
  $timestamp = json_encode($timestamp);

    echo "<pre>";
    print_r($price);
    echo "</pre>";
    echo "<pre>";
    print_r($timestamp);
    echo "</pre>";
?>