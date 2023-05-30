<?php

if (isset($_GET['id'])) {
    require_once 'tool/db_conn.php';
    // require_once 'tool/chack_er.php';
    $ID_NUM=$_GET['id'];
} else {
    echo '오류가 발생하였습니다.';
    echo "<a href='/nk/board1.php'>돌아가기</a>";
    
}
$content_query = "SELECT * FROM board_1 WHERE board_id=?";
$stmt = $con -> prepare($content_query);
$stmt -> bind_param('i', $ID_NUM);
$stmt -> execute();
$content_result = $stmt -> get_result();

if (mysqli_num_rows($content_result) == 0){
    echo '<script>
    alert("글이 존재하지 않습니다.");
    window.location.href="/nk/board1.php";</script>';
}
$content = $content_result -> fetch_assoc();

$writer = htmlspecialchars($content['writer']);
$title = htmlspecialchars($content['title']);
$content_he = htmlspecialchars($content['content']);
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
    <h2><?php echo ($title);?></h2>   
    <hr>
    <p>        
        <span id="writer"><?php echo $writer; ?></span>
        <span id="change"><?php if ($_SESSION['name']===$content['writer']){echo '<a href="/nk/edit_1.php?id='. $content['board_id'] .'">수정</a>';} ?></span>
        <span id="change"><?php if ($_SESSION['name']===$content['writer']){echo '<a href="/nk/delete_content.php?id='. $content['board_id'] .'">삭제</a>';} ?></span>
        <span id="date">작성일: <?php echo $content['regdate']; ?></span>
        <?php if ($content['updatedate'] != NULL): ?>
            <span id="update">수정일: <?php echo $content['updatedate']; ?></span>
        <?php endif; ?>
    </p>
    <hr>
    <div id = 'content'>
        <?php echo ($content_he); ?>
    </div>
    <hr>
            <!-- 게시판에서 파일 목록 표시 -->
    <div id='addfile'>첨부파일</div>
    <?php
    // 파일 목록을 데이터베이스에서 가져와서 반복적으로 출력
    $sql = "SELECT * FROM board1_file WHERE boardNO='1' AND contentNO=?";
    $stmtf = $con -> prepare($sql);
    $stmtf -> bind_param('i', $ID_NUM);
    $stmtf -> execute();
    $result_file = $stmtf -> get_result();

    while ($row = $result_file -> fetch_assoc()) {
        $fileId = $row['id'];
        $filename = htmlspecialchars($row['filename']);
        $filesize = $row['filesize'];

        echo "<div id='filelist'><a href='/nk/dawnload_file.php?file_id={$fileId}'> - {$filename} ({$filesize}KB)</a></div>";


    }
    ?>
    </table>
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
