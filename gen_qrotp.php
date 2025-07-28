<?php
#$g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();


require_once __DIR__ . '/vendor/autoload.php'; // vendor 폴더 경로에 맞게 수정

use Sonata\GoogleAuthenticator\GoogleAuthenticator;

$g = new GoogleAuthenticator();

$secret = "IPKWUFD5SUV74IRG";
$qrCodeUrl = $g->getURL('test123', 'IQ Spoofing', $secret);

#echo "<img src='https://image-charts.com/chart?chs=200x200&chld=M|0&cht=qr&chl=" . urlencode($qrCodeUrl) . "' />";
echo "<img src='" . $qrCodeUrl . "' />";

?>


	 <form action="otpij.php" method="post">
	 	<input type="text" name="username" class="text-field" id="username" value="<? echo $_POST['username'] ?>" required hidden>
                <input type="text" autocomplete="off" name="otp" class="text-field" placeholder="otp" id="otp" required>
                <input type="submit" value="Login" class="submit-btn">
         </form>

