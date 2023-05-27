<!-- file_up1.php -->

<?php

$targetDir = "uploads/"; // 업로드된 파일이 저장될 디렉토리 경로
require_once "tool/chack_er.php";

// 파일이 업로드되었는지 확인
if(!isset($_POST["submit"])) {
    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]); // 업로드된 파일의 경로와 이름, basenaem함수는 파일경로에서 파일명만 가져옴.    
    $uploadOk = 1; // 파일 업로드가 성공적으로 이루어졌는지 여부를 나타내는 변수

    // 파일 유형 검사 (예시: 이미지 파일만 업로드 가능하도록 제한)
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION)); // 확장자 추출 및 소문자 변환
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // 파일 업로드 실행
    if ($uploadOk == 0) {
        echo "<script> alert('error [0]'); 
        window.history.back();
        </script>";
    } 

    // 업로드된 파일의 정보를 MySQL 데이터베이스에 저장하는 코드 작성
    $filename = basename($_FILES["fileToUpload"]["name"]);
    $filesize = $_FILES["fileToUpload"]["size"];
    $uploader = $_SESSION["name"];
    $boardNO = "1";
    $contentNO = $id; //upload_content_1.php에서 정의



    // MySQL 데이터베이스 연결 및 파일 정보 저장
    require_once('tool/db_conn.php'); 


    // 파일 정보를 데이터베이스 테이블에 삽입하는 SQL 쿼리 실행
    $sql = "INSERT INTO board1_file (filename, filesize, uploader, uploadDate, boardNO, contentNO) VALUES ('$filename', '$filesize', '$uploader', NOW(), '$boardNO', '$contentNO')";

    if (mysqli_query($con, $sql)) {
        $idName = mysqli_insert_id($con); // AUTO_INCREMENT로 생성된 primary key 값을 가져옴
        echo "<script> alert('Success');
        </script> ";
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            // 파일 업로드 성공
            echo "<script> alert('The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.');
            window.location.href = '/nk/board1.php';</script>";        
            
        }
    }
        
    // MySQL 연결 종료
    $con->close();
}


    
?>
