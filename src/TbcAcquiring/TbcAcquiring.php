<?php

namespace TbcAcquiring;

class TbcGateway
{	
	/*
	* Tbc Acquiring Gateway
	*/

	private $gateway = 'https://securepay.ufc.ge:18443/ecomm2/MerchantHandler';
	
	/*
	* Application SSL Credentials
	*/

	private $password = 'JKg78fgJHFkwq53gJH';
	private $cert = 'E:\www\htdocs\TbcAcquiring\src\certs\cert1\file.crt.pem';
	private $key =  'E:\www\htdocs\TbcAcquiring\src\certs\cert1\file.key.pem';

	private $response = null;

	public function __construct(){

	}

	public static function getInstance(){		
		return new self();
	}
	
	public function createOrder( $data ){		
		$data = (array) $data;
		$response = $this->_doRequest( $data );	
		$this->response = $response;	
		return $this;	
	}	

	public function extractTransactionID(){		
		if( !empty($this->response) ){
			return trim( str_replace('TRANSACTION_ID:', '', $this->response) );
		}		
	}	
		
	private function _doRequest( $request_array = null )
	{ 
		$fields_string = '';

		foreach($request_array as $key=>$value)
		{
			$fields_string .= $key.'='.$value.'&';
		}

		$fields_string = substr( $fields_string, 0, (strlen($fields_string) - 1) );

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($curl, CURLOPT_VERBOSE, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSLCERT, $this->cert );
		curl_setopt($curl, CURLOPT_SSLKEY,  $this->key ) ;
		curl_setopt($curl, CURLOPT_SSLKEYPASSWD, $this->password);
		curl_setopt($curl, CURLOPT_URL, $this->gateway);

		$result = curl_exec($curl);
		$info = curl_getinfo($curl);
		$error = curl_error($curl); 
		return $result;
	}	
	
	protected function _parseXml($xml, $tag)
	{
		$regV = '/(?<=^|>)[^><]+?(?=<\/' . $tag . '|$)/i';
		preg_match($regV, $xml, $result);
		if (empty($result))
		{
			return false;
		}
		return $result[0];
	}	
}
