<!-- upload_content_1.php -->
<?php
session_start();
// require_once('tool/chack_er.php');

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    require_once('tool/db_conn.php');
    //db연결
    $title = $_POST['title'];
    $content = $_POST['content'];
    $writer = $_SESSION['name'];
    //변수 정의
    $upload_query = "INSERT INTO board_1 (writer, title, content, regdate) VALUES('$writer', '$title', '$content', NOW())";
    //쿼리문
if(strlen($title) >= 50){
    echo "<script> alert('제목 글자수는 50자 제한입니다.');
    window.history.back();</script>";
    //제목 글자수 제한
}elseif (strlen($content) >= 1000) {
    echo "<script> alert('본문 글자수는 1000자 제한입니다.');
    window.history.back();</script>";
    //본문 글자수 제한
}

    if (mysqli_query($con, $upload_query)) {
        echo "<script>
        alert('글이 성공적으로 업로드 되었습니다.');
        window.location.href = '/nk/board1.php'
        </script>";
        //업로드 성공시
   
    } else {
        echo "<script>
        alert('업로드에 실패하였습니다.')
        </script>";
        //업로드 실패시
            
    }
}elseif(!isset($_SESSION['loggedin'])) {   
    echo "<script>
    alert('글을 작성하기 위해서는 로그인이 필요합니다.');
    window.location.href = 'board1.php';
    </script>";
    //로그인 필요 안내
}
?>


