<?php
require_once __DIR__ . '/vendor/autoload.php'; // 정확한 상대경로

use Sonata\GoogleAuthenticator\GoogleAuthenticator;

$userInputCode = $_GET['otp']; // 사용자가 입력한 6자리 코드
$g = new GoogleAuthenticator();


$secret = "5O4YJ25QQDWYFJHMT2C6XC4I5OF2I===";
$isValid = $g->checkCode($secret, $userInputCode); // $secret은 DB에서 가져온 값

if ($isValid) {
    echo "인증 성공!";
} else {
    echo "인증 실패!";
}
if ("5O4YJ25QQDWYFJHMT2C6XC4I5OF2I===" == $userInputCode) {
	echo "1";
} else { 
	echo "0";
}

?>
