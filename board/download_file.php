<!-- download_file.php -->
<?php
$board_id = $_GET['board_id'];
$boardNO=$board_num;

//db 연결
require_once "../tool/db_conn.php";
// require_once 'tool/chack_er.php';
$file_query = "SELECT * FROM board1_file WHERE boardNO=? AND contentNO=?";
$stmt = $con -> prepare($file_query);
$stmt -> bind_param('ii', $boardNO, $board_id);
$stmt -> execute();
$file_result = $stmt -> get_result();
$file_row = $file_result -> fetch_assoc();

// 다운로드할 파일의 경로 및 파일명
$filename = $file_row['filename'];
$filecontent = $file_row['filecontent'];

// 파일이 존재하는지 확인
if ($file_result->num_rows === 1) {
    // 다운로드할 파일의 정보 설정
    header('Content-Description: File Transfer'); //컨텐츠 설명. 전송데이터가 파일임.
    header('Content-Type: application/octet-stream'); //컨텐츠가 MIME타입을 설정. 이진파일을 나타냄.
    header('Content-Disposition: attachment; filename="' . $filename . '"'); //다운로드될 파일명설정. 첨부(파일을 열지않고 다운.)
    header('Expires: 0'); //만료시간. 즉시만료.
    header('Cache-Control: must-revalidate'); //캐시 강제 재검사. 만약 변경이 있을경우 캐시를 업데이트. 아니면 캐시 사용.
    header('Pragma: public'); //캐시저장 허용
    header('Content-Length: ' . strlen($filecontent)); //컨텐츠의 길이 설정. 효율, 진행상황 표시, 변조나 공격 탐지등.
    ob_clean(); //출력 버퍼 제거
    flush(); //출력 버퍼를 비우고 즉시 출력. 이를 클라이언트에게 전송. 전송지연최소화.

    echo $filecontent;
    // 파일 다운로드 후 종료
    exit;
} else {
    // 파일이 존재하지 않는 경우 처리할 내용
    echo "<script> alert('파일을 찾을 수 없습니다.');
    window.history.back();
    </script>";
    exit;
}
?>
