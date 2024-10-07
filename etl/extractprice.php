<?php
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.coinranking.com/v2/coin/Qwsogvtv82FCd/history",
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

  if($e = curl_error($curl)) {
    echo $e;
}
else {
    $price = json_decode($response, true);
    print_r($price);
}

return $price;

curl_close($ch); 

  ?>