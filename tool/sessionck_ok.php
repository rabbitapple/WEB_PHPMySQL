<?php
// 세션시작 확인
require_once 'tool/session_open.php';
// 로그인 안했으면 로그인페이지로감
if (!isset($_SESSION['loggedin'])) {
	header('Location: syjdr.html');
	exit;
} 
?>