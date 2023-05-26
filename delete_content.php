<!-- delete_content.php -->
<?php
session_start();
require_once('tool/chack_er.php');

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if (isset($_GET['id'])) {
        if (isset($_GET['delete'])){
            require_once 'tool/db_conn.php';
            //db연결
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
                $delete_query = "DELETE FROM board_1 WHERE board_id='$ID_NUM' AND writer='$NAME_S'";              
                if($_GET['delete']){
                    mysqli_query($con, $delete_query);
                    echo "<script>alert('글삭제가 완료되었습니다.');
                    window.location.href = '/nk/board1.php';</script>";
                    
                }
                exit;

            }
        } else{
            ?><script>
            if (confirm('정말로 글을 삭제하시겠습니까?')) {
                window.location.href = '/nk/delete_content.php?delete=true&id=<?php echo $_GET["id"];?>';
                //글삭제 확인
            } else {
                history.back();
            }
            </script><?php
        }
    } else {
        echo "<script>
        alert('오류가 발생하였습니다.');
        window.location.href = '/nk/board1.php';
        </script>";
        exit;
    
    }
    

}elseif(!isset($_SESSION['loggedin'])) {   
    echo "<script>
    alert('글 삭제는 작성자만 가능합니다.');
    window.location.href = 'board1.php';
    </script>";
    exit;
}


?>