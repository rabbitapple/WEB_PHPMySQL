<?php
    require_once "./variable.php";
?>

<?php

require_once "../tool/db_conn.php";    //db연결

    

//변수 정의
$title = $_POST['title'];
$content = $_POST['content'];
$writer = $_POST['username']; 
$content_password = $_POST['CPW'];

$upload_query = "INSERT INTO board_" . $board_num . " (writer, title, content, regdate, CPW) VALUES(?, ?, ?, NOW(), ?)"; //쿼리문
$stmt_uq = $con -> prepare($upload_query);
$stmt_uq -> bind_param('ssss', $writer, $title, $content, $content_password);


//글자수 제한
if(strlen($title) >= 50){
    echo "<script> alert('제목 글자수는 50자 제한입니다.');
    window.history.back();</script>";
    exit;
    
}elseif (strlen($content) >= 1000) {
    echo "<script> alert('본문 글자수는 1000자 제한입니다.');
    window.history.back();</script>";
    exit;
}



//게시글 업로드
if ($stmt_uq -> execute()) {        
    $id = mysqli_insert_id($con); // AUTO_INCREMENT로 생성된 primary key 값을 가져옴


    //파일 업로드 
    require_once './file_up.php';

    echo "<script>
    alert('글이 성공적으로 업로드 되었습니다.');
    window.location.href = './content.php/?id=". $id."';
    </script>";
    exit;

    

} else {
    echo "<script>
    alert('업로드에 실패하였습니다.')
    </script>";  
    exit;         
}



?>


