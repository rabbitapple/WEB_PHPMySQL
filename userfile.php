<?php

// include 'tool/chack_er.php';
// 세션
include 'tool/session_open.php';
// 홈으로 리다이렉트
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
// 데이터베이스 연결
require_once 'tool/db_conn.php';


// 유저 정보 쿼리
$stmt = $con->prepare('SELECT username, email FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();

// 데이터베이스 연결 종료
$con->close();
?>

<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
</head>
<body>
    <h1>User Profile</h1>
    <p>Username: <?php echo htmlspecialchars($username); ?></p>
    <p>Email: <?php echo htmlspecialchars($email); ?></p>
    <a href="logout.php">Logout</a>
    <a href="index.php">돌아가기</a>
</body>
</html>