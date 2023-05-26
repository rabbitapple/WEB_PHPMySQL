<?php
// 모든 세션 변수 삭제
$_SESSION = array();

// 세션 쿠키 삭제
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 마지막으로 세션 파괴
session_destroy();
//출력 버퍼링 활성화. 스크립트 종료시 실행
ob_start();
// 로그아웃 후 리다이렉트할 페이지로 이동
header("location: index.php");
exit;
?>