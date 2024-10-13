<?php
// The file to connect to MYSQL DATABASE and select data for last 12hours from Table called PriceHistory 

  include_once('config.php');
header('Content-Type: application/json');  
try {
    $pdo = new PDO($dsn, $username, $password, $options);


    $sql = "SELECT price, timestamp FROM PriceHistory WHERE timestamp >= NOW() - INTERVAL 36 HOUR";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $priceHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
  
  
  echo json_encode($priceHistory);
  

  return $priceHistory;

?>