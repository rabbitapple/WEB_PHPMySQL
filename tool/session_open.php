<!-- 세션 열기.
만약 세션이 안열려있으면 열기 -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>