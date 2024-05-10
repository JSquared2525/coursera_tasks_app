<?php
$data = json_decode(file_get_contents('php://input'), true);
$login = $data['login'];
$pass = $data['password'];

if ($login == 'admin' && $pass == 'admin') {
    echo "success";
} else {
    echo 'failure';
}
?>