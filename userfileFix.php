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
    <script>
        function openadress() {
            
            window.open("adress_serch.php", "_blank", "width=500,height=400,top=50%,left=50%,margin-top=-200px,margin-left=-250px");
        }
        function cancel() {
        // 아무런 동작도 하지 않음
        }
    </script> 
    <title>User Profile</title>
    <link rel="stylesheet" href="/nk/CSS/userfileFix.css">
</head>
<body>
    <h1><a href="/nk/index.php">IQ Spoofing</a></h1>  
    <h2>개인정보 변경</h2>
    <hr id = 'nana'>
    <div>
        <form action='/nk/userfile_upload.php' method='post' id ="content">
            <p name="UID" class="UID" id="UID" >Username: <?php echo htmlspecialchars($username); ?></p>            
            <label id="Text">비밀번호 : </label>
	    <input type="password" name="UPW" class="UPW" autocomplete="off" placeholder="비밀번호" id="UPW" require>
            <br>
            <label id="Text">비밀번호 확인 : </lable>
            <input type="password" name="UPWC" class="UPWC" autocomplete="off" placeholder="비밀번호 확인" id="UPWC" require>
            <br>
            <label id="Text">Email : </label>
            <input type="email" name="email" class="email" placeholder="email" id="email" require>
            <br>
            <label id="Text">주소 : </label>
            <input type="adress" id="adress" value="주소" required readonly>
            <button type="button" onclick="openadress()">주소검색</button>
            <br>
            <input type="submit" value="변경" class="submit-btn">
        </form>
    </div>   
</body>
</html>
