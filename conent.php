<?php

if (isset($_GET['id'])) {
    require_once 'tool/db_conn.php';
    // require_once 'tool/chack_er.php';
    $ID_NUM=$_GET['id'];
} else {
    echo '오류가 발생하였습니다.';
    echo "<a href='/nk/board1.php'>돌아가기</a>";
    
}
$content_query = "SELECT * FROM board_1 WHERE board_id='$ID_NUM'";
$content_result = mysqli_query($con, $content_query);
if (mysqli_num_rows($content_result) == 0){
    echo '<script>
    alert("글이 존재하지 않습니다.");
    window.location.href="/nk/board1.php";</script>';
}
$content = mysqli_fetch_assoc($content_result);
?>


<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <title>IQ Spoofing</title>
    <link rel="stylesheet" href="/nk/CSS/content.css">
    
</head>
<body>
    <h1><a href="/nk/index.php">IQ Spoofing</a></h1>
    <h2><?php echo ($content['title']);?></h2>   
    <hr>
    <p>        
        <span id="writer"><?php echo $content['writer']; ?></span>
        <span id="change"><?php if ($_SESSION['name']===$content['writer']){echo '<a href="/nk/edit_1.php?id='. $content['board_id'] .'">수정</a>';} ?></span>
        <span id="change"><?php if ($_SESSION['name']===$content['writer']){echo '<a href="/nk/delete_content.php?id='. $content['board_id'] .'">삭제</a>';} ?></span>
        <span id="date">작성일: <?php echo $content['regdate']; ?></span>
        <?php if ($content['updatedate'] != NULL): ?>
            <span id="update">수정일: <?php echo $content['updatedate']; ?></span>
        <?php endif; ?>
    </p>
    <hr>
    <div id = 'content'>
        <?php echo ($content['content']); ?>
    </div>
    <hr>
    <form>
        <div id = 'ui'> 
            <a id = 'before' href='/nk/conent.php/?id=<?php echo $ID_NUM-1 ?>'> 이전글 </a>
            <a id = 'board_list' href='/nk/board1.php'>목록</a>
            <a id = 'after' href='/nk/conent.php/?id=<?php echo $ID_NUM+1 ?>'> 다음글 </a>
        </div>        
    </form> 
 
</body>

</html>
