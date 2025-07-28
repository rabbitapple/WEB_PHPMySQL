<!-- delete_content.php -->
<?php
session_start();
// require_once('tool/chack_er.php');

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if (isset($_GET['id'])) {
        if (isset($_GET['delete'])){
            require_once '../tool/db_conn.php';
            //db연결
            // require_once 'tool/chack_er.php';
            $ID_NUM=$_GET['id'];
            $NAME_S=$_SESSION['name'];

            $content_query = "SELECT * FROM board_" . $board_num ." WHERE board_id=?";
            $stmt = $con -> prepare($content_query);
            $stmt -> bind_param('i', $ID_NUM);
            $stmt -> execute();
            $content_result = $stmt -> get_result();
            $content_row = $content_result -> fetch_assoc();

            if (mysqli_num_rows($content_result) === 0){
                echo "<script>
                alert('글이 존재하지 않습니다.');
                window.location.href = './board.php';
                </script>";
                exit;
            }
            if ($content_row['writer']===$_SESSION['name']){
                $delete_query = "DELETE FROM board_" . $board_num ." WHERE board_id=? AND writer=?";
                $stmt = $con -> prepare($delete_query);
                $stmt -> bind_param('is', $ID_NUM, $NAME_S);
                                
                if($_GET['delete']){
                    $stmt -> execute();
                    echo "<script>alert('글삭제가 완료되었습니다.');
                    window.location.href = './board.php';</script>";
                    
                }
                exit;

            }
        } else{
            ?><script>
            if (confirm('정말로 글을 삭제하시겠습니까?')) {
                window.location.href = './delete_content.php?delete=true&id=<?php echo (htmlspecialchars($_GET["id"]));?>';
                //글삭제 확인
            } else {
                history.back();
            }
            </script><?php
        }
    } else {
        echo "<script>
        alert('오류가 발생하였습니다.');
        window.location.href = './board.php';
        </script>";
        exit;
    
    }
    

}elseif(!isset($_SESSION['loggedin'])) {   
    echo "<script>
    alert('글 삭제는 작성자만 가능합니다.');
    window.location.href = './board.php';
    </script>";
    exit;
}


?>
