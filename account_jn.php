<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>회원가입</title>
    <link rel="stylesheet" href="CSS/account_jn.css">
    <link rel="stylesheet" href="font_fi.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nanum+Pen+Script&display=swap" integrity="sha384-+xfQsLQeLUrjxXmn3ZNQZxMuwZTGVOrUlLvMEWsR9CAcZljXYYLtzdQN7HecUuqR" crossorigin="anonymous">
	<script>
        function openadress() {
            
            window.open("adress_serch.php", "_blank", "width=500,height=400,top=50%,left=50%,margin-top=-200px,margin-left=-250px");
        }
        function cancel() {
        // 아무런 동작도 하지 않음
        }
    </script> 
</head>
<body>
    <h1>IQ Spoofing</h1>
    <form method="post" action="account_in_back.php">
        <label>사용자 이름</label>
        <input type="text" name="username" required>
        <br>
        <label>비밀번호</label>
        <input type="password" name="password" autocomplete="off" required>
        <br>
        <label>비밀번호 확인</label>
        <input type="password" name="confirm_password" autocomplete="off" required>
        <br>
        <label>이메일</label>
        <input type="email" name="email" required>
        <br>
        <lavel>주소</label>
        <input type="adress" id="adress" value="주소" required readonly>
        <button type="button" onclick="openadress()">주소검색</button>
        <br>
        <input type="submit" name value="회원가입">
    </form>
</body>
</html>
