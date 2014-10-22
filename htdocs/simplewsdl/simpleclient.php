<?php


require_once '../includes/gj_utility.inc.php';
require_once '../includes/gj_soap.inc.php';
require 'service_functions.php';

global $gjDebug;
global $gjXDebug;
global $gjLocal;
$gjLocal = gjAreLocal();
$gjDebug = true;  //for both set, do not comment out
$gjXDebug = false;

/*


$client = new SoapClient("some.wsdl", array('soap_version'   => SOAP_1_2));

$client = new SoapClient("some.wsdl", array('login'          => "some_name",
                                            'password'       => "some_password"));


*/
try{
	$client = new SoapClient('http://garyjohnsoninfo.info/gjsoap/simplewsdl/simpleO.wsdl');
	$response = array();
	//$response['helloResponse'] = $client->getHello();
	$response['goodbyeResponse'] = $client->getGoodbye();
	//print_r($response);
} catch(SoapFault $fault){
	echo "<pre style='margin:2em;'>";
	print_r($fault);
	//echo 'Soap Error - faultcode: '.$fault->faultcode.' faultstring: '.$fault->faultstring;

	generateDebugReport('browser',get_defined_vars());
	print "</pre>";
}
echo "<pre style='margin:2em;'>";
echo '<br>';
var_dump($response);
echo '</pre>';

?>


