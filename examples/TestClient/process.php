<?php

require '../../src/TbcAcquiring/TbcAcquiring.php';
use TbcAcquiring\TbcGateway;

try{

	if( empty( $_POST['amount'] ) )
		throw new Exception('Amount not defined');

	if( empty( $_POST['currency'] ) )
		throw new Exception('Currency not defined');

	$tbc = new TbcGateway();

	$data = array( 

		'command' => 'v',
		'amount' => $_POST['amount'],
		'currency' => $_POST['currency'],
		'client_ip_addr' => '92.51.96.50',

	 );

	$response = $tbc->createOrder( $data );

	?>
	<html>
		<head>
			<title>Merchant example post template to ECOMM</title>
			<script type='text/javascript' language='javascript'>
			function redirect() {
			  document.returnform.submit();
			}
			</script>
		</head>
		<body onLoad='javascript:redirect()'>
			<form name='returnform' action='https://securepay.ufc.ge/ecomm2/ClientHandler' method='POST'>
			  <input type='text' size="50" name='trans_id' value='<?php echo trim( str_replace('TRANSACTION_ID:', '', $response) ) ?>'>
			 
				<noscript>
				    <center>Please click the submit button below.<br>
				    <input type='submit' name='submit' value='Submit'></center>
				</noscript>
			</form>
		 
		</body>
	</html>
	<?php
}
catch( Exception $e ){
	header('Location: index.php?msg='.$e->getMessage());
}