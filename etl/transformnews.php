<?php


// Decode the JSON data
$json_data = json_decode(file_get_contents('extractnews.php'), true); // Replace 'data.json' with your actual data source

// Check for decoding errors
if (json_last_error() !== JSON_ERROR_NONE) {
  echo 'Error decoding JSON data: ' . json_last_error_msg();
  exit;
}

// Display information about the data
echo "Number of items: " . $json_data['items'] . "\n";
echo "Sentiment score definition: \n" . $json_data['sentiment_score_definition'] . "\n";
echo "Relevance score definition: \n" . $json_data['relevance_score_definition'] . "\n\n";

// Loop through each feed item
foreach ($json_data['feed'] as $feed_item) {
  echo "**Title:** " . $feed_item['title'] . "\n";
  echo "**URL:** " . $feed_item['url'] . "\n";
  echo "**Published:** " . $feed_item['time_published'] . "\n";
  echo "**Authors:** " . implode(', ', $feed_item['authors']) . "\n";
  echo "**Summary:** " . $feed_item['summary'] . "\n";
  echo "**Overall Sentiment:** " . $feed_item['overall_sentiment_label'] . " (" . $feed_item['overall_sentiment_score'] . ")\n";

  // Loop through ticker sentiment (if available)
  if (isset($feed_item['ticker_sentiment'])) {
    echo "**Ticker Sentiment:**\n";
    foreach ($feed_item['ticker_sentiment'] as $ticker) {
      echo "  * " . $ticker['ticker'] . " (Relevance: " . $ticker['relevance_score'] . ", Sentiment: " . $ticker['ticker_sentiment_label'] . " (" . $ticker['ticker_sentiment_score'] . "))\n";
    }
  }

  echo "\n";
}

?>


?>