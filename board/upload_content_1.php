<!-- upload_content_1.php -->
<?php
session_start();
// require_once('../tool/chack_er.php');
require_once "../tool/csrftoken_test.php";
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    require_once "../tool/db_conn.php";    //db연결

    if(token_test()){
        
    
        //변수 정의
        $title = $_POST['title'];
        $content = $_POST['content'];
        $writer = $_SESSION['name']; 

        $upload_query = "INSERT INTO board_" . $board_num . " (writer, title, content, regdate) VALUES(?, ?, ?, NOW())"; //쿼리문
        $stmt_uq = $con -> prepare($upload_query);
        $stmt_uq -> bind_param('sss', $writer, $title, $content);
        
        
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
    }else{
        echo "<script> alert('ERROR[0]');
            window.history.back();</script>";
            exit;
    }

}elseif(!isset($_SESSION['loggedin'])) {   
    echo "<script>
    alert('글을 작성하기 위해서는 로그인이 필요합니다.');
    window.location.href = './board1.php';
    </script>";
    exit;
}

?>