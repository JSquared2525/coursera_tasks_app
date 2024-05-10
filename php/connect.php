<?php
$dsn = 'mysql:host=localhost;dbname=tasks';
$db_username = 'admin';
$password='admin';

try {
$db = new PDO($dsn, $db_username, $password);
} catch (ExceptionClass $exception_name) {
    echo "broken";
}

 ?>