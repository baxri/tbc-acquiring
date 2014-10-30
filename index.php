<?php

require 'src/TbcAcquiring/TbcAcquiring.php';


use TbcAcquiring\TbcGateway;

$tbc = new TbcGateway();

$data = array( 

	'comand' => 'v',
	'amount' => '100',
	'cur' => '981',
	'client_ip_addr' => '92.51.96.50',

 );

$response = $tbc->createOrder( $data );
	


echo '<pre>';
print_r( $response );
die;


