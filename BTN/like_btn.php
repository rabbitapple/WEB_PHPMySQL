<html>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">



<html>
<head>
    <style>
        #md {
            display: flex;
            justify-content: center;
        }
        .like-button {
            display: inline-block;
            cursor: pointer;
        }

        .like-button i {
            font-size: 24px;
            color: #000;
        }

        .like-button i:hover {
            color: red;
        }

        .like-button i.clicked {
            color: #ff0000;
        }
    </style>
    <script>
        function handleLikeClick() {
            if (sessionok===0){
                alert("로그인이 필요합니다.");
            }
            likestyle();
            submitlike();
        }
        function likestyle() {
            var icon = document.querySelector('.like-button i');
            icon.classList.toggle('clicked');
        }
        function submitlike() {
            fetch('../likes.php/?id=<?php echo $ID_NUM ?>');
            location.reload();
        }
    </script>
</head>
<body>
    <div id="md" class="like-button" onclick="handleLikeClick()">
        <i class="far fa-heart"></i>
    </div>

</body>
</html>
<?php
require_once '../tool/session_open.php';
require_once '../tool/db_conn.php';
// require_once '../tool/chack_er.php';
if(!$_SESSION['loggedin']){
    echo "<script> var sessionok = 0;</script>";
   
}

$ID_NUM = $_GET["id"];

$content_query = "SELECT * FROM board_" . $board_num . " WHERE board_id=?";
$stmt = $con -> prepare($content_query);
$stmt -> bind_param('i', $ID_NUM);
$stmt -> execute();
$content_result = $stmt -> get_result();

$content = $content_result -> fetch_assoc();

$likes = $content['likes'];
$likers = $content['likers'];
if($likers!=NULL){
    $data = json_decode($likers, true); //json 배열을 php배열
    if(in_array($_SESSION['id'], $data)){
        echo "<script>likestyle();</script>";
        
    }
}
?>
