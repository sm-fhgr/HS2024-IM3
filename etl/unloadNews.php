<?php
include_once('config.php');
header('Content-Type: application/json');

try {
    $pdo = new PDO($dsn, $username, $password, $options);

    // Fetch the news feed and identify duplicates
    $sql = "SELECT * FROM Feed ORDER BY time_published DESC LIMIT 100";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $newsFeed = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepare the deletion query
    $deleteSql = "DELETE FROM Feed WHERE id NOT IN (
        SELECT MAX(id) FROM Feed GROUP BY time_published
    )";
    $deleteStmt = $pdo->prepare($deleteSql);

    // Execute the deletion query
    $deleteStmt->execute();

    // Re-fetch the updated news feed
    $sql = "SELECT * FROM Feed ORDER BY time_published DESC LIMIT 100";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $newsFeed = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Return the updated news feed as JSON
echo json_encode($newsFeed);
return $newsFeed;