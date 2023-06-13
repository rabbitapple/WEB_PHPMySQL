<!-- file_up1.php -->
<?php
$filename = basename($_FILES["fileToUpload"]["name"]);
// require_once "../tool/chack_er.php";

// 파일이 업로드되었는지 확인
if(empty($_FILES["fileToUpload"]['name'])) {

}elseif(!empty($_FILES["fileToUpload"]['name'])) {

        $uploadOk = 1; // 파일 업로드가 성공적으로 이루어졌는지 여부를 나타내는 변수

    // 파일 유형 검사 (예시: 이미지 파일만 업로드 가능하도록 제한)
    $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION)); // 확장자 추출 및 소문자 변환
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "<script> alert('JPG, JPEG, PNG & GIF파일만 업로드 가능합니다.'); 
        window.history.back();
        </script>";
        $uploadOk = 0;
    }

    // NULL byte 탐지
    if(strpos($targetfile, "\0")){
        $uploadOk = 0;
    }

    //파일 크기 제한
    $maxFileSize = 1048576; // 1MB 제한
    if ($_FILES['fileToUpload']['size'] > $maxFileSize) {
    echo "<script> alert('파일 크기가 제한을 초과했습니다.'); 
    window.history.back();
    </script>";
    $uploadOk = 0;
    }   

    // 파일 업로드 실행여부 검사
    if ($uploadOk == 0) {
        echo "<script> alert('error [0]'); 
        window.history.back();
        </script>";    
    } else{
        // 업로드될 파일의 정보를 MySQL 데이터베이스에 저장하는 코드 작성
        
        $filecontent = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
        $filesize = $_FILES["fileToUpload"]["size"];
        $uploader = $writer;
        $boardNO = $board_num;
        $contentNO = $id; //upload_content.php에서 정의

        if(strlen($filename) >= "25"){
            echo "<script> alert('파일 이름의 길이는 확장자명 포함 25자 이내여야 합니다.'); 
            window.history.back();
            </script>"; 
        }


        // MySQL 데이터베이스 연결 및 파일 정보 저장
        require_once "../tool/db_conn.php";

        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        // 파일 정보를 데이터베이스 테이블에 삽입하는 SQL 쿼리 실행
        $sql = "INSERT INTO board1_file (filename, filesize, uploader, uploadDate, boardNO, contentNO, filecontent) VALUES (?, ?, ?, NOW(), ?, ?, ?)";
        $stmts = $con -> prepare($sql);
        $stmts -> bind_param('sssiis', $filename, $filesize, $uploader, $boardNO, $contentNO, $filecontent);
        $stmts -> execute();
        
        // MySQL 연결 종료
        $con->close();
    }
}
?>