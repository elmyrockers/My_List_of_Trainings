<?php
require_once 'vendor/autoload.php';


use OTPHP\TOTP;


$secret = 'ZAK7AGEBHQPXCSK54GL46SZ6AGAZAKJ5TUFWH3FXDM2O43OIFEW2YGWWCD4TRCXTPLHNWVGTQ5B6MXLSIIV335PCUUXNJBQWLQ64LNI';
// $secret = '';
if ( $secret ) {
	$totp = TOTP::createFromSecret( $secret );
} else {
	$totp = TOTP::generate();
	// Save secret into database
		$secret = $totp->getSecret();
}



$code = $_POST[ 'code' ] ?? null;
$msg = '';
if ( $code ) {
	if ( $totp->verify($code) ) $msg = '<div class="alert alert-success">Code is Valid</div>';
	if ( !$totp->verify($code) ) $msg = '<div class="alert alert-danger">Code is Invalid</div>';
}


// Generate the QR code URI with the label
	$totp->setIssuer('Jodoh4U'); // Set the issuer
	$totp->setLabel('elmyrockers@gmail.com'); // Set the account name
	$qrCodeUri = $totp->getQrCodeUri(
		'https://api.qrserver.com/v1/create-qr-code/?data=[DATA]&size=300x300&ecc=M',
		'[DATA]'
	);
	$codeServer = $totp->now();
//------------------------------------------------------------------------------------------------------?>

<img src='<?=$qrCodeUri ?>'>
<br><br>
<strong>SETUP KEY:</strong> <?=$secret ?>
<br><br>
<strong>CODE:</strong> <?=$codeServer ?>
<br><br>
<?=$msg ?>
<form method="post">
	<label for="code" style="font-weight: bold;">6 Digit Code:</label>
	<input id="code" type="text" name="code">
	<button>Validate</button>
</form>