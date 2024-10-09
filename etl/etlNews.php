<?php

$ch = curl_init("https://www.alphavantage.co/query?function=NEWS_SENTIMENT&tickers=CRYPTO:BTC&apikey=UU3RCFGRDEOZO0A3");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$response = curl_exec($ch);

if($e = curl_error($ch)) {
    echo $e;
}
else {
    include_once('config.php');
    $pdo=new PDO($dsn, $username, $password, $options);
    $newsfeed = json_decode($response, true);
    echo  "<pre>";
    print_r($newsfeed["feed"]);
    echo "</pre>";
    foreach($newsfeed["feed"] as $feed_item) {
        $title = $feed_item['title'];
        $url = $feed_item['url'];
        $source = $feed_item['source'];
        $time_published = $feed_item['time_published'];
        $overall_sentiment_label = $feed_item['overall_sentiment_label'];
        $overall_sentiment_score = $feed_item['overall_sentiment_score'];
        $stmt = $pdo->prepare("INSERT INTO Feed (title, url, source, time_published, overall_sentiment_label, overall_sentiment_score) VALUES (:title, :url, :source, :time_published, :overall_sentiment_label, :overall_sentiment_score)");
        $stmt->execute(['title' => $title, 'url' => $url, 'source' => $source, 'time_published' => $time_published, 'overall_sentiment_label' => $overall_sentiment_label, 'overall_sentiment_score' => $overall_sentiment_score]);
    }
}

return $newsfeed;

curl_close($ch);  

?>