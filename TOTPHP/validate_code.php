<?php
require_once 'vendor/autoload.php';


use OTPHP\TOTP;

$secret = 'ERMAKVAZB4W4XHK4JPZTKVD4LH5VTTILJ37OEGJL3OPPIRUWANU4KJUF7N5W6TPC32O3IXVP4XXRMMRJYFDJLW5PNUDIMJ53YJ6ZN2A';
$totp = TOTP::createFromSecret( $secret );

// Checking Form
	$code = $_POST[ 'code' ] ?? null;
	$msg = '';
	if ( $code ) {
		if ( $totp->verify($code) ) $msg = '<div class="alert alert-success">Code is Valid</div>';
		if ( !$totp->verify($code) ) $msg = '<div class="alert alert-danger">Code is Invalid</div>';
	}
//------------------------------------------------------------------------------------------------------?>

<?=$msg ?>
<form method="post">
	<label for="code" style="font-weight: bold;">6 Digit Code:</label>
	<input id="code" type="text" name="code">
	<button>Validate</button>
</form>