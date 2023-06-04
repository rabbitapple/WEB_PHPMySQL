<!-- csrftoken_gneerater.php -->
<?php
//csrftoken 생성 및 저장
// require_once "chack_er.php"; // 에러확인
require_once "session_open.php"; //세션시작

//토큰생성 및 저장 함수
function token_generat(){
    $csrftoken = bin2hex(random_bytes(32));
    $_SESSION['csrftoken']=$csrftoken;

    return $csrftoken;
}
?>