<!-- csrftoken_test.php -->
<?php
//require_once "chack_er.php"; // 에러확인
require_once "session_open.php"; //세션시작

//토큰 검사함수
function token_test() {
    if(!empty($_SESSION['csrftoken']) && hash_equals($_SESSION['csrftoken'],$_POST['csrftoken'])){
        return true;
        $_SESSION['csrftoken'] = null;
    }else{
        return false;
    }
}
?>