
<?php
include_once('config.php');
header('Content-Type: application/json');  
try {
    $pdo = new PDO($dsn, $username, $password, $options);


    $sql = "SELECT * FROM Feed ORDER BY time_published DESC LIMIT 50";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $newsFeed = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
  
  
  echo json_encode($newsFeed);
  

  return $newsFeed;

?>