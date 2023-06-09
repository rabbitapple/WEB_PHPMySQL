<!-- update_content_1.php -->
<?php
session_start();
// require_once 'tool/chack_er.php';
require_once "../tool/csrftoken_test.php";

if(token_test()){

}else{
    echo "<script> alert('ERROR[0]');
    window.history.back();</script>";
    exit;
}


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if (isset($_GET['id'])) {    
        require_once '../tool/db_conn.php';
        // require_once '../tool/chack_er.php';
        $ID_NUM=$_GET['id'];
        $NAME_S=$_SESSION['name'];

        $content_query = "SELECT * FROM board_" . $board_num ." WHERE board_id=?";
        $stmtc = $con -> prepare($content_query);
        $stmtc -> bind_param('i', $ID_NUM);    
        $stmtc -> execute();
        $content_result = $stmtc -> get_result();
        $content_row = $content_result -> fetch_assoc();
        if (mysqli_num_rows($content_result) === 0){
            echo "<script>
            alert('글이 존재하지 않습니다.');
            window.location.href = './board.php';
            </script>";
            exit;
        }
        if ($content_row['writer']===$_SESSION['name']){
            $title = mysqli_real_escape_string($con, $_POST['title']);
            $content = mysqli_real_escape_string($con, $_POST['content']);
            $id = mysqli_real_escape_string($con, $_GET['id']);
            $writer = mysqli_real_escape_string($con, $_SESSION['name']);

            $update_query = "UPDATE board_" . $board_num . " SET title=?, content=?, updatedate=NOW() WHERE board_id=? AND writer=?";
            $stmtu = $con -> prepare($update_query);
            $stmtu -> bind_param('ssis', $title, $content, $id, $writer);    
            $stmtu -> execute();


            if($stmtu -> execute()) { 
                echo "<script>alert('글 수정이 완료되었습니다.');
                window.location.href = './board.php';</script>";
                exit;
            } else{
                echo "<script>
                alert('오류가 발생하였습니다.');
                window.location.href = './board.php';
                </script>";
                exit;
            }


        } else {
            echo "<script>
            alert('작성자만 글을 수정할 수 있습니다.');
            window.location.href = './board.php';
            </script>";
            exit;
        }
    } else {
        echo "<script>
        alert('오류가 발생하였습니다.');
        window.location.href = './board.php';
        </script>";
        exit;
    
    }
} elseif (!isset($_SESSION['loggedin'])) {   
?>
    <script>
        alert('작성자만 글을 수정 할 수 있습니다.');
        window.location.href = "./board1.php";
        
    </script>   
    <?php
}

?>





