<!-- update_content_1.php -->
<?php
session_start();
require_once 'tool/chack_er.php';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if (isset($_GET['id'])) {    
        require_once 'tool/db_conn.php';
        // require_once 'tool/chack_er.php';
        $ID_NUM=$_GET['id'];
        $NAME_S=$_SESSION['name'];

        $content_query = "SELECT * FROM board_1 WHERE board_id='$ID_NUM'";
        $content_result = mysqli_query($con, $content_query);
        $content_row = mysqli_fetch_assoc($content_result);
        if (mysqli_num_rows($content_result) === 0){
            echo "<script>
            alert('글이 존재하지 않습니다.');
            window.location.href = '/nk/board1.php';
            </script>";
            exit;
        }
        if ($content_row['writer']===$_SESSION['name']){
            $title = mysqli_real_escape_string($con, $_POST['title']);
            $content = mysqli_real_escape_string($con, $_POST['content']);
            $id = mysqli_real_escape_string($con, $_GET['id']);
            $writer = mysqli_real_escape_string($con, $_SESSION['name']);

            $update_query = "UPDATE board_1 SET title='$title', content='$content', updatedate=NOW() WHERE board_id='$id' AND writer='$writer'";
            if(mysqli_query($con, $update_query)) { 
                echo "<script>alert('글 수정이 완료되었습니다.');
                window.location.href = '/nk/board1.php';</script>";
            } else{
                echo "<script>
                alert('오류가 발생하였습니다.');
                window.location.href = '/nk/board1.php';
                </script>";
                exit;
            }


        } else {
            echo "<script>
            alert('작성자만 글을 수정할 수 있습니다.');
            window.location.href = '/nk/board1.php';
            </script>";
            exit;
        }
    } else {
        echo "<script>
        alert('오류가 발생하였습니다.');
        window.location.href = '/nk/board1.php';
        </script>";
        exit;
    
    }
} elseif (!isset($_SESSION['loggedin'])) {   
?>
    <script>
        alert('작성자만 글을 수정 할 수 있습니다.');
        window.location.href = "board1.php";
        
    </script>   
    <?php
}

?>





