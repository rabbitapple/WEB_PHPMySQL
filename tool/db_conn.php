<!-- db정보 불러오기 -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$DATABASE_HOST = '192.168.0.37';
$DATABASE_USER = 'rabbit';
$DATABASE_PASS = '1234';
$DATABASE_NAME = 'phplogin';

// 연결
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>
