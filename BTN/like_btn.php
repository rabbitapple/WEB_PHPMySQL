<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">


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
        var elements;
        var likes;
        var clicknum = 0;
        var text
        window.onload = function() {
        elements = document.getElementsByClassName("likephp");
        text = elements[0].textContent;
        likes = parseInt(text);
        };
        function handleLikeClick() {
            if (sessionok===0){
                alert("로그인이 필요합니다.");
            }else{
                likestyle();
                submitlike();
            }
        }
        function likestyle() {

            var icon = document.querySelector('.like-button i');
            icon.classList.toggle('clicked');
            clicknum++;
            
        }
        function submitlike() {
            fetch('../likes.php/?id=<?php echo (htmlspecialchars($ID_NUM)) ?>');
             // 텍스트를 숫자로 변환
             
            if (clicknum % 2 === 0) {
                elements[0].textContent = likes - 1;
                elements[1].textContent = likes - 1;
                likes--;
            } else {
                elements[0].textContent = likes + 1; 
                elements[1].textContent = likes + 1; 
                likes++;
            }

            



            // location.reload();
        }
    </script>
</head>
<body>
    <div id="md" class="like-button">
        <i class="far fa-heart" onclick="handleLikeClick()"></i>
    </div>

</body>
</html>
<?php
require_once '../tool/session_open.php';
require_once '../tool/db_conn.php';
// require_once '../tool/chack_er.php';
if(!$_SESSION['loggedin']){
    echo "<script> var sessionok = 0;</script>";   
}else{
    echo "<script> var sessionok = 1;</script>";   

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
