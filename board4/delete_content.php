<?php
    require_once "./variable.php";
?>

<?php


if (isset($_GET['id'])) {
    if (isset($_GET['delete'])){
        if (isset($_POST['CPW'])){
            echo "123";
            require_once '../tool/db_conn.php';
            //db연결
            require_once '../tool/chack_er.php';
            $ID_NUM=$_GET['id'];

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
            if ($content_row['CPW']===$_POST['CPW']){
                $delete_query = "DELETE FROM board_" . $board_num ." WHERE board_id=?";
                $stmt = $con -> prepare($delete_query);
                $stmt -> bind_param('i', $ID_NUM);
                                
                if($_GET['delete']){
                    $stmt -> execute();
                    echo "<script>alert('글삭제가 완료되었습니다.');
                    window.location.href = './board.php';</script>";
                    
                }
                exit;


        }else {
            echo "111";
            echo "<form action='#' method='post'>
            <input type='password' name='CPW' placeholder='Password' id='CPW' require>
            <input type='submit'>
            </form>";
        }

        }
    } else{
        ?><script>
        if (confirm('정말로 글을 삭제하시겠습니까?')) {
            window.location.href = './delete_content.php?delete=true&id=<?php echo $_GET["id"];?>';
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





?>