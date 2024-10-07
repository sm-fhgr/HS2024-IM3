<?php

$ch = curl_init("https://www.alphavantage.co/query?function=NEWS_SENTIMENT&tickers=CRYPTO:BTC&apikey=UU3RCFGRDEOZO0A3");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$response = curl_exec($ch);

if($e = curl_error($ch)) {
    echo $e;
}
else {
    $newsfeed = json_decode($response, true);
    print_r($newsfeed);
}

return $newsfeed;

curl_close($ch);  

?>