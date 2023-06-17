<!-- <?php
  error_reporting( E_ALL );
  ini_set( "display_errors", 1 );
?> -->


<?php
require_once 'tool/db_conn.php'; 
// //디버깅 마지막 연결 호출의 오류 반환
if ( mysqli_connect_errno() ) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}       

if ( !isset($_POST['username'], $_POST['password']) ) {
	// 오류메시지
	exit('ID랑 Password를 입력하세요');
}

// 준비
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	// 바인딩( string이므로 s)
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute(); // 준비된 쿼리 실행
	// 결과저장
	$stmt->store_result();

	if ($stmt->num_rows > 0) { //행의 수량를 반환하고 그 값이 0보다크다면
		$stmt->bind_result($id, $hashed_password);// id password 바인딩
		$stmt->fetch(); //결과를 배열로 뽑아냄  store result에서 저장된 정보	
		// account가 존재하면 비밀번호를 확인
		//해시된 암호를 저장하기 위해 등록 파일에서 password_hash 사용. 암호해시 생성

		password_hash($hashed_password, PASSWORD_DEFAULT);
		// if ($_POST['password']===$hashed_password) { //암호가 일치하는지 확인
		if (password_verify($_POST['password'], $hashed_password)) { //해시된 암호와 비교
			// 인증성공시 로그인
			//세션 생성. 사용자 로그인 확인. 쿠키와 같이 작동하나 서버 데이터를 기억함.
			
			session_start();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $_POST['username']; 
			$_SESSION['id'] = $id;
			header('Location: index.php');
		} else {
			// 잘못된 비밀번호
			echo '안타깝군요! 다시 도전해보세요.ㅎㅎ<br><a href=syjdr.html>돌아가기</a>';
		}
	} else {	
		// 잘못된 사용자이름
		echo '안타깝네요 ㅋ 다시 도전해보세요.ㅎㅎ<br><a href=syjdr.html>돌아가기</a>';
	}





	$stmt->close();
}







?>
