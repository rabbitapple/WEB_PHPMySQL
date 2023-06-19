<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <title>IQ Spoofing</title>
    <link rel="stylesheet" href="../CSS/write_1.css">
    
</head>
<body>
    <h1><a href="/nk/index.php">IQ Spoofing</a></h1>  
    <h2>글 수정</h2>
    <hr id = 'nana'>
    <div id = 'content'>
        <form action='./update_content.php?id=<?php echo $_GET["id"];?>' method='post'>
            <input type="text" name="title" class="text-field" placeholder="제목을 입력해주세요." id="input_title" value="<?php echo $title;?>" require>
            <hr>
            <textarea  name="content" class="text-field" placeholder="내용을 입력해주세요." id="input_content" required rows="4" cols="40"><?php echo $content;?> </textarea>
            <hr>
            <input type="hidden" value="<?php echo $_POST['CPW']; ?>" id="CPW" name="CPW">
            <br>
            <input type="submit" value="저장" class="submit-btn">
        </form>
    </div>
</body>

</html>