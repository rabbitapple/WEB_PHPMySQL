<?php

require_once __DIR__ . '/vendor/autoload.php'; // 정확한 상대경로

use Sonata\GoogleAuthenticator\GoogleAuthenticator;

$g = new GoogleAuthenticator();
#$secret = $g->generateSecret(); // 시크릿 키 생성


$secret = $g->generateSecret();

#$secret = "5O4YJ25QQDWYFJHMT2C6XC4I5OF2I===";
// DB에 사용자와 함께 $secret 저장해야함.
echo "사용자 시크릿 키: " . $secret;


?>
