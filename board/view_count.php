<?php
require_once "../tool/session_open.php";

// 세션 유지 시간 설정 (1주일 = 7일 * 24시간 * 60분 * 60초)
$session_lifetime = 7 * 24 * 60 * 60;
session_set_cookie_params($session_lifetime);

// 세션 유지 시간 설정 (gc_maxlifetime)
ini_set('session.gc_maxlifetime', $session_lifetime);

if (!isset($_SESSION['viewed_posts'])) {
    $_SESSION['viewed_posts'] = array();
}

if (!in_array($board_num . "/" . $ID_NUM, $_SESSION['viewed_posts'])) {
    require_once '../tool/db_conn.php';
    // require_once '../tool/chack_er.php';
    $_SESSION['viewed_posts'][] = $board_num . "/" . $ID_NUM;
    
    $content_query = "UPDATE board_" . $board_num . " SET views = views + 1 WHERE board_id=?";
    $stmtv = $con -> prepare($content_query);
    $stmtv -> bind_param('i', $ID_NUM);
    $stmtv -> execute();


} else {

}


?>