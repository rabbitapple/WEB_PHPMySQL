<?php
// include 'tool/chack_er.php';

session_start();
//db 연결
require_once 'tool/db_conn.php';

// POST 방식으로 데이터를 받기
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 사용자가 입력한 값들을 변수에 저장.
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $adress = $_POST['adress'];

    if (preg_match('/^[a-zA-Z0-9_-]{5,20}$/',$username)) {
        // 아이디가 유효한 경우, 회원가입 처리 수행
    } else{        
        echo "<script>
            alert('아이디는 5자 이상 20자 이하의 대소문자 알파벳과 특수기호 -,_ 만을 사용할 수 있습니다.');
            history.back();
            </script>";
        
        exit;
        //아이디가 유효하지 않을경우 php종료.
    }


    if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,16}$/', $password)) {
        //^: 문자열의 시작
        // (?=.*[a-z]): 소문자가 적어도 하나 이상 포함되어야 함
        // (?=.*[A-Z]): 대문자가 적어도 하나 이상 포함되어야 함
        // (?=.*\d): 숫자가 적어도 하나 이상 포함되어야 함
        // (?=.*[$@$!%*?&]): 특수문자 중 하나가 적어도 하나 이상 포함되어야 함
        // [A-Za-z\d$@$!%*?&]{8,16}: 대문자, 소문자, 숫자, 특수문자 중에서 8자에서 16자까지의 문자열이 포함되어야 함
        // $: 문자열의 끝
        if (strpos($password, "'") !== false || strpos($password, '"') !== false) {            
            echo "<script>
            alert('비밀번호는 따옴표나 쌍따옴표를 사용할 수 없습니다.');
            history.back();
            </script>";
            exit;
        } else {
            // 비밀번호가 유효한 경우, 회원가입 처리 수행
        }
    } else {
        echo "<script>
        alert('비밀번호는 8~16자까지의 대문자, 소문자, 숫자, 특수문자를 각각 한 개 이상 포함해야 합니다.');
        history.back();
        </script>";      
        exit;
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // 이메일 주소가 유효한 경우, 처리를 진행
    } else {
        // 이메일 주소가 유효하지 않은 경우, 에러 메시지 출력
        echo "<script>
        alert('유효한 이메일주소가 아닙니다.');
        history.back();
        </script>";
        exit;
    }


    // 비밀번호와 비밀번호 확인이 일치하는지 확인.
    if ($password !== $confirm_password) {
        echo "<script>
            alert('비밀번호 확인이 일치하지 않습니다.');
            history.back();
            </script>";
            exit;
    } else {

    }

    // 사용자가 입력한 이메일이 이미 존재하는지 확인.
    // $stmt = $con->prepare('SELECT id FROM username WHERE email = ?');
    $stmt = $con->prepare('SELECT username, email FROM accounts WHERE id = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row) {
        echo "<script>
            alert('이미 등록된 이메일입니다.');
            history.back();
            </script>";
            exit;
        
    }


    $stmt = $con->prepare('SELECT id FROM accounts WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row) {
        echo "<script>
            alert('이미 등록된 아이디 입니다.');
            history.back();
            </script>";
            exit;
        
    }


      
    // 사용자가 입력한 정보를 데이터베이스에 저장.
    $stmt = $con->prepare('INSERT INTO accounts (username, password, email, address_num) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssss', $username, password_hash($password, PASSWORD_DEFAULT), $email, $adress);
    if ($stmt->execute()) {
        echo "<script>
            alert('회원가입에 성공하였습니다.');
            window.location.href='/nk/index.php';
            </script>";
            exit;
    
        
    } else {
        echo "<script>
            alert('회원가입에 실패하였습니다.');
            history.back();
            </script>";
            exit;
    }
        
}
?>