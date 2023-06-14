<?php
    require_once "./variable.php";
?>


<!-- edit_1.php -->
<?php
// require_once '../tool/chack_er.php';

if (isset($_GET['id'])) {    
    require_once '../tool/db_conn.php';
    $ID_NUM=$_GET['id'];

    $content_query = "SELECT * FROM board_" . $board_num . " WHERE board_id=?";
    $stmt = $con -> prepare($content_query);
    $stmt -> bind_param('i', $ID_NUM);
    $stmt -> execute();
    $content_result = $stmt -> get_result();
    $content_row = $content_result -> fetch_assoc();

    if (mysqli_num_rows($content_result) === 0){
        echo "<script>
        alert('글이 존재하지 않습니다.');
        window.history.back();
        </script>";
        exit;
    }
    if (isset($_POST['CPW'])){
        if (password_verify($_POST['CPW'], $content_row['CPW'])){
            $title=$content_row['title'];
            $content=$content_row['content'];
            require_once "./edithtml.php";
        } else {
            echo "<script>
            alert('작성자만 글을 수정할 수 있습니다.');
            window.history.back();
            </script>";
            exit;
        }
    } else {
        require_once "CPWsubmit.php";
    }
} else {
    echo "<script>
    alert('오류가 발생하였습니다.');
    window.history.back();
    </script>";
    exit;

}


?>

