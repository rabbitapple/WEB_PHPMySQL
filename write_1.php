<!-- write_1.php -->
<?php
session_start();
// require_once 'tool/chack_er.php';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) { 
    //로그인 확인
} elseif (!isset($_SESSION['loggedin'])) {   
?>
    <script>
        alert('글을 작성하기 위해서는 로그인이 필요합니다.');
        window.location.href = "board1.php";
        
    </script>   
    <?php
    //로그인이 되지 않았을 경우 로그인이 필요하다는 창을 띄움.
}

?>

<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <title>IQ Spoofing</title>
    <link rel="stylesheet" href="/nk/CSS/write_1.css">
    
</head>
<body>
    <h1><a href="/nk/index.php">IQ Spoofing</a></h1>  
    <h2>글쓰기</h2>
    <hr id = 'nana'>
    <div id = 'content'>
        <form action='/nk/upload_content_1.php' method='post'>
            <input type="text" name="title" class="text-field" placeholder="제목을 입력해주세요." id="input_title" require>
            <hr>
            <textarea  name="content" class="text-field" placeholder="내용을 입력해주세요." id="input_content" required rows="4" cols="40"></textarea>
            <hr>
            <input type="submit" value="저장" class="submit-btn">
        </form>
    </div>
</body>

</html>
