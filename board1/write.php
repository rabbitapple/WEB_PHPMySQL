<?php
    require_once "./variable.php";
?>

<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <title>IQ Spoofing</title>
    <link rel="stylesheet" href="../CSS/write_1.css">
    
</head>
<body>
    <h1><a href="/nk/index.php">IQ Spoofing</a></h1>  
    <h2>글쓰기</h2>
    <hr id = 'nana'>
    <div id = 'content'>
        <form action='./upload_content.php' method='post' enctype='multipart/form-data'>
        <!-- <form action="/nk/file_up1.php" method="post" enctype="multipart/form-data"> -->
            <input type="text" name="username" class="text-field" placeholder="제목을 입력해주세요." id="username" require>
            <input type="text" name="title" class="text-field" placeholder="제목을 입력해주세요." id="input_title" require>
            <hr>
            <textarea  name="content" class="text-field" placeholder="내용을 입력해주세요." id="input_content" required rows="4" cols="40"></textarea>
            <hr>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <hr>                 
            <input type="submit" value="저장" class="submit-btn" name="submit">
                 
        </form>
    </div>
</body>

</html>
