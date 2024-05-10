<?php

require_once 'connect.php';


$json = file_get_contents('php://input');


$data = json_decode($json);
try {

    $procedureName = "mark_task_complete";
    $id = $data->id;
    $sql = "CALL $procedureName(?)";

 
    $stmt = $db->prepare($sql);
    $params = array($id);
    $stmt->execute($params);

   
    $stmt = null;
    $db = null;
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    file_put_contents('error_log.txt', $error_message . PHP_EOL, FILE_APPEND);
    header('Content-Type: application/json');
    echo json_encode(["error" => $error_message]);
}
?>