<!-- db정보 불러오기 -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'rabbit';
$DATABASE_PASS = '1234';
$DATABASE_NAME = 'phplogin';

// 연결
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
?>