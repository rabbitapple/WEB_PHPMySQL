<!-- edit_1.php -->
<?php
session_start();
// require_once 'tool/chack_er.php';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if (isset($_GET['id'])) {    
        require_once 'tool/db_conn.php';
        // require_once 'tool/chack_er.php';
        $ID_NUM=$_GET['id'];
        $NAME_S=$_SESSION['name'];

        $content_query = "SELECT * FROM board_1 WHERE board_id=?";
        $stmt = $con -> prepare($content_query);
        $stmt -> bind_param('i', $ID_NUM);
        $stmt -> execute();
        $content_result = $stmt -> get_result();
        $content_row = $content_result -> fetch_assoc();

        if (mysqli_num_rows($content_result) === 0){
            echo "<script>
            alert('글이 존재하지 않습니다.');
            window.location.href = '/nk/board1.php';
            </script>";
            exit;
        }
        if ($content_row['writer']===$_SESSION['name']){
            $title=$content_row['title'];
            $content=$content_row['content'];
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

<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <title>IQ Spoofing</title>
    <link rel="stylesheet" href="/nk/CSS/write_1.css">
    
</head>
<body>
    <h1><a href="/nk/index.php">IQ Spoofing</a></h1>  
    <h2>글 수정</h2>
    <hr id = 'nana'>
    <div id = 'content'>
        <form action='/nk/update_content_1.php?id=<?php echo $_GET["id"];?>' method='post'>
            <input type="text" name="title" class="text-field" placeholder="제목을 입력해주세요." id="input_title" value="<?php echo $title;?>" require>
            <hr>
            <textarea  name="content" class="text-field" placeholder="내용을 입력해주세요." id="input_content" required rows="4" cols="40"><?php echo $content;?> </textarea>
            <hr>
            <input type="submit" value="저장" class="submit-btn">
        </form>
    </div>
</body>

</html>
