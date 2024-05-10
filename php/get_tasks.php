<?php
require 'connect.php';

// Decode JSON POST data
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true); // Decoding as associative array

if (!isset($db) || !($db instanceof PDO)) {
    $error_message = "Database connection is broken";
    file_put_contents('error_log.txt', $error_message . PHP_EOL, FILE_APPEND);
    header('Content-Type: application/json');
    echo json_encode(["error" => $error_message]);
    exit;
}

try {
    $sql = "SELECT * FROM tasks";
    $params = [];

    if (isset($input['filter']) && isset($input['search'])) {
        if ($input['filter'] != 'all') {
            $sql .= " WHERE status = :filter AND task LIKE :search";
            $params = ['filter' => $input['filter'], 'search' => '%' . $input['search'] . '%'];
        } else {
            $sql .= " WHERE task LIKE :search";
            $params = ['search' => '%' . $input['search'] . '%'];
        }
    } elseif (isset($input['filter'])) {
        if ($input['filter'] != 'all') {
            $sql .= " WHERE status = :filter";
            $params = ['filter' => $input['filter']];
        }
    } elseif (isset($input['search'])) {
        $sql .= " WHERE task LIKE :search";
        $params = ['search' => '%' . $input['search'] . '%'];
    }

    $stmt = $db->prepare($sql);
    $stmt->execute($params);

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $tasks = $stmt->fetchAll();

    header('Content-Type: application/json');
    echo json_encode($tasks);
} catch(PDOException $e) {
    $error_message = $e->getMessage();
    file_put_contents('error_log.txt', $error_message . PHP_EOL, FILE_APPEND);
    header('Content-Type: application/json');
    echo json_encode(["error" => $error_message]);
}
?>
