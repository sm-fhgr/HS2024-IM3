<?php

$ch = curl_init("https://www.alphavantage.co/query?function=NEWS_SENTIMENT&tickers=CRYPTO:BTC&apikey=UU3RCFGRDEOZO0A3");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$response = curl_exec($ch);

if($e = curl_error($ch)) {
    echo $e;
}
else {
    $decoded = json_decode($response, true);
    print_r($decoded);
}

curl_close($ch);  


// file_put_contents('output.json', $response);

// print_r($response);
// return $response;

// exit;

?>