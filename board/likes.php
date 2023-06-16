<?php
require_once '../tool/session_open.php';

// require_once '../tool/chack_er.php';

if(!$_SESSION['loggedin']){
    echo "<script> alert('로그인이 필요합니다.'); </script>";
    exit;
}

require_once '../tool/db_conn.php';

$ID_NUM = $_GET["id"];

$content_query = "SELECT * FROM board_" . $board_num . " WHERE board_id=?";
$stmt = $con -> prepare($content_query);
$stmt -> bind_param('i', $ID_NUM);
$stmt -> execute();
$content_result = $stmt -> get_result();

$content = $content_result -> fetch_assoc();

$likes = $content['likes'];
$likers = $content['likers'];

if($likers!=NULL){
    $data = json_decode($likers, true); //json 배열을 php배열
    if(in_array($_SESSION['id'], $data)){
        $i = array_search($_SESSION['id'], $data);
        unset($data[$i]);
        $data = array_values($data);
        $data = json_encode($data);
        $like_up = "UPDATE board_". $board_num . " SET likers = '" . $data. "', likes = likes - 1 WHERE board_id=?";
        $stmtl = $con -> prepare($like_up);
        $stmtl -> bind_param('i', $ID_NUM);
        $stmtl -> execute();

    }else{
        $i = count($data);
        $data[$i]=$_SESSION['id'];
        $data = array_values($data);
        $data = json_encode($data);
        $like_up = "UPDATE board_". $board_num . " SET likers = '" . $data. "', likes = likes + 1 WHERE board_id=?";
        $stmtl = $con -> prepare($like_up);
        $stmtl -> bind_param('i', $ID_NUM);
        $stmtl -> execute();

    }

}elseif($likers===NULL){
    $data=[$_SESSION['id']];
    $data = json_encode($data);
    $like_up = "UPDATE board_". $board_num . " SET likers = JSON_ARRAY(" .$_SESSION['id'] . "), likes = likes + 1 WHERE board_id=?";
    $stmtl = $con -> prepare($like_up);
    $stmtl -> bind_param('i', $ID_NUM);
    $stmtl -> execute();

}

?>