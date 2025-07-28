<?php

session_start();
require __DIR__ . '/vendor/autoload.php';
use Jumbojett\OpenIDConnectClient;

$oidc = new OpenIDConnectClient(
    'https://trial-3585083.okta.com/oauth2/default',
    '0oarusa7xlHoh1hna697',
    '6GTuUx7KGDsPjzMjp2UUDnLLHKaCWYWV13v0YjAqzT7nPGrsI1V1aRRVoevh4PpH'
);

// 로그인 URL로 리디렉션
$oidc->setRedirectURL('https://tech.softwidesec.com/nk/login_rd.php');
$oidc->authenticate();

$name = $oidc->requestUserInfo('name');
echo "Hello, $name!";
?>
