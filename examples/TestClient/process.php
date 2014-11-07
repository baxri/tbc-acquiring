<?php


try{

	if( empty( $_POST['amomunt'] ) )
		throw new Exception('Amount not defined');

	if( empty( $_POST['currency'] ) )
		throw new Exception('Currency not defined');
		

}
catch( Exception $e ){
	header('Location: index.php?msg='.$e->getMessage());
}




print_r($_POST);
die();