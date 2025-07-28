<?php
session_start();
session_write_close();

require 'vendor/autoload.php';
$oidc = new Jumbojett\OpenIDConnectClient(
    'https://trial-3585083.okta.com/oauth2/default',
    '0oarusa7xlHoh1hna697',
    '6GTuUx7KGDsPjzMjp2UUDnLLHKaCWYWV13v0YjAqzT7nPGrsI1V1aRRVoevh4PpH'
);


$oidc->setRedirectURL('https://tech.softwidesec.com/nk/login_rd.php');
/*
$oidc->authenticate();

 

$userinfo = $oidc->requestUserInfo();

// 세션 저장
$_SESSION['loggedin'] = true;
$_SESSION['name'] = $userinfo->name ?? 'Unknown';
$_SESSION['id'] = $userinfo->sub ?? null;


if(isset($_SESSION['loggedin'])){
	header("Location: /nk/index.php");
} else {
	header("Location: ./okij.php");
};
	


exit;
*/
try {
    $oidc->authenticate();
    $userinfo = $oidc->requestUserInfo();
    $_SESSION['loggedin'] = true;
    $_SESSION['name'] = $userinfo->name;
    header("Location: /nk/");
    exit;
} catch (Exception $e) {
    echo "Authentication failed: " . $e->getMessage();
    echo "<br><br><a href='okij.php'>okta SSO Login</a>";

}




?>

