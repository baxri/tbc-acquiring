<?php

namespace TbcAcquiring;

class TbcGateway
{	
	/*
	* Tbc Acquiring Gateway
	*/

	private $gateway = 'https://securepay.ufc.ge:18443/ecomm2/MerchantHandler';
	
	/*
	* Application Credentials
	*/

	private $password = 'JKg78fgJHFkwq53gJH';
	private $cert = 'E:\www\htdocs\TbcAcquiring\src\certs\cert1\file.crt_cleaned.pem';
	private $key =  'E:\www\htdocs\TbcAcquiring\src\certs\cert1\file.key_cleaned.pem';

	private $cert_from_http = 'http://localhost/TbcAcquiring/src/certs/cert1/file.crt_cleaned.pem';
	private $key_from_http =  'http://localhost/TbcAcquiring/src/certs/cert1/file.key_cleaned.pem';

	public function __construct(){

	}

	public static function getInstance(){		
		return new self();
	}
	
	public function createOrder( $data ){
		
		$data = (array) $data;
		$response = $this->_doRequest( $data );	

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
	  curl_setopt($curl, CURLOPT_SSLCERT, $this->cert);
	  curl_setopt($curl, CURLOPT_SSLKEY,  $this->key) ;
	  curl_setopt($curl, CURLOPT_SSLKEYPASSWD, $this->password);
	  curl_setopt($curl, CURLOPT_URL, $this->gateway);

	  $result = curl_exec($curl);
	  $info = curl_getinfo($curl);
	  $error = curl_error($curl);
	  
	  echo '<pre>';
	  print_r( $error );
	  die;
	 
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
