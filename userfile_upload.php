<?php
session_start();
// require_once 'tool/chack_er.php';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // 데이터베이스 연결
    require_once 'tool/db_conn.php';


    // 유저 정보 쿼리
    $stmt = $con->prepare('SELECT username, email FROM accounts WHERE id = ?');
    $stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute();
    $stmt->bind_result($username, $email);
    $stmt->fetch();
} elseif (!isset($_SESSION['loggedin'])) {  
     
?>
    <script>
        alert('로그인이 필요한 서비스 입니다.');
        window.location.href = "board1.php";
        
    </script>   
    <?php
}

?>
