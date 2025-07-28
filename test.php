<?php

require_once __DIR__ . '/vendor/autoload.php'; // 정확한 상대경로

use Sonata\GoogleAuthenticator\GoogleAuthenticator;

$userInputCode = $_GET["otp"] ; // 사용자가 입력한 6자리 코드
$g = new GoogleAuthenticator();


$secret = "IPKWUFD5SUV74IRG";
$isValid = $g->checkCode($secret, $userInputCode);

echo $isValid;

if($isValid!=Null) {
	echo 1;
} else { 
	echo 0;};
try {
    $isValid = $g->checkCode($secret, $userInputCode);
    var_dump($isValid); // true or false
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage(); // 실제 오류 메시지를 출력
}
?>
