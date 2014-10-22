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

$options = array('soap_version' => SOAP_1_2,
'trace' => 1);

try{
	$client = new SoapClient('http://garyjohnsoninfo.info/gjsoap/simplewsdl/simpleO.wsdl',$options);
	$response = array();
	//$response['helloResponse'] = $client->getHello();
	$response['goodbyeResponse'] = $client->getGoodbye();
	//print_r($response);
} catch(SoapFault $fault){
	echo "<pre style='margin:2em;color:red'>";
	print_r($fault);
	//echo 'Soap Error - faultcode: '.$fault->faultcode.' faultstring: '.$fault->faultstring;
	echo "</pre>";
}
echo '<hr>';
echo "<pre style='margin:2em;color:black;'>";
echo 'Reponse <br>';
var_dump($response);
echo '</pre>';

echo '<hr>';
echo "<pre style='margin:2em;font-family:\"Courier New\",Courier,monospace;line-height:1em'>";
echo 'Soap Client trace' . "\n";;
echo "REQUEST:" . $client->__getLastRequest()."\n";
echo "RESPONSE:" .$client->__getLastResponse()."\n";
echo "REQUEST HEADERS:" . $client->__getLastRequestHeaders();
echo "RESPONSE HEADERS:" . $client->__getLastResponseHeaders();
echo 'Debug Report <br>';

echo '</pre>';
//Notice: Array to string conversion in F:\bit5411\apps\gjsoap\htdocs\includes\gj_utility.inc.php on line 341
//fix above

generateDebugReport('browser',get_defined_vars());
?>


