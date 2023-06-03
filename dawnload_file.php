<!-- dawnloda_File.php -->
<?php
$board_id = $_GET['board_id'];
$boardNO="1";

//db 연결
require_once "tool/db_conn.php";
// require_once 'tool/chack_er.php';
$file_query = "SELECT * FROM board1_file WHERE boardNO=? AND contentNO=?";
$stmt = $con -> prepare($file_query);
$stmt -> bind_param('ii', $boardNO, $board_id);
$stmt -> execute();
$file_result = $stmt -> get_result();
$file_row = $file_result -> fetch_assoc();

// 다운로드할 파일의 경로 및 파일명
$pathinfo = pathinfo($file_row['filename'],PATHINFO_EXTENSION);
$filePath = "uploads/{$file_id}.{$pathinfo}";

// 파일이 존재하는지 확인
if (file_exists($filePath)) {
    // 다운로드할 파일의 정보 설정
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . $file_row['filename']);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filePath));

    // 파일을 읽고 출력 버퍼에 쓰기
    readfile($filePath);

    // 파일 다운로드 후 종료
    exit;
} else {
    // 파일이 존재하지 않는 경우 처리할 내용
    echo "<script> alert('파일을 찾을 수 없습니다.');
    window.history.back();
    </script>";
}
?>
