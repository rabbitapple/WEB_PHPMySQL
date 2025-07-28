<?php
require_once './GoogleAuthenticater.php';
 
$ga = new GoogleAuthenticator();
#$secret = $ga->createSecret();

$secret ="PXAGJ73SV44CKV27";
echo "Secret is: ".$secret."<br>";
 
$qrCodeUrl = $ga->getQRCodeGoogleUrl('test123', $secret, 'IQ Spoofing');
echo "Google Charts URL for the QR-Code: ".$qrCodeUrl."<br>";
 
$oneCode = $ga->getCode($secret);
echo "Checking Code '$oneCode' and Secret '$secret'<br>";
 
$checkResult = $ga->verifyCode($secret, $oneCode, 2);    // 2 = 2*30sec clock tolerance
if ($checkResult) {
    echo 'OK';
} else {
    echo 'FAILED';
}
?>
<br>
<img src="<?=$qrCodeUrl?>">
