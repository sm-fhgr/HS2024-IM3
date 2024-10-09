<?php
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.coinranking.com/v2/coin/Qwsogvtv82FCd/history?timePeriod=24h",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "x-access-token: coinrankingfa5471a783d222de584205fd8a365972765878998246bded"
    ),
  ));

  $response = curl_exec($curl);

  if ($e = curl_error($curl)) {
    echo $e;
  } else {
    include_once('config.php');
    $pdo = new PDO($dsn, $username, $password, $options);
    $priceHistory = json_decode($response, true);

    // echo "<pre>";
    // print_r($priceHistory);
    // echo "</pre>";

    // Get the price and timestamp from the API response with a loop that goes through array priceHistory["data"]["history"][x] where x is the index of the price and timestamp

    foreach($priceHistory["data"]["history"] as $priceHistory) {
      $price = $priceHistory["price"];
      $timestamp = $priceHistory["timestamp"];
      // echo "<pre>";
      // print_r($price);
      // echo "</pre>";

      // Convert the Unix timestamp to SQL TIMESTAMP format (YYYY-MM-DD HH:MM:SS)
    $sqlTimestamp = date('Y-m-d H:i:s', $timestamp);

    // Insert the price and the converted timestamp into the database
    $stmt = $pdo->prepare("INSERT INTO PriceHistory (price, timestamp) VALUES (:price, :timestamp)");
    $stmt->execute(['price' => $price, 'timestamp' => $sqlTimestamp]);
    }
  }

  curl_close($curl);

  return $price;
?>
