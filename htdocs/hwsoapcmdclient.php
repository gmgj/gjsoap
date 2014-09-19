<?php
/*
hello world hwsoapclient.php

looks like we got no XML document
http://lxr.php.net/xref/PHP_TRUNK/ext/soap/php_packet_soap.c

*/
require_once 'includes/gj_utility.inc.php';
require_once 'includes/gj_soap.inc.php';
date_default_timezone_set('America/New_York');

echo 'processing started :'.date("D, d F Y H:i:s e"), "\n";
//gmdate(DATE_RFC822)
$startTime=microtime(true);
global $gjDebug;
global $gjXDebug;
global $gjLocal;
$gjLocal = true;
$gjDebug = true;  //for both set, do not comment out
$gjXDebug = false;

const GJRETRIES = 2;
const GJSLEEPSECS = 10;
/*
destructive test if Invalid server location
err: HTTP msg: Not Found
	$options = array('location' => 'http://localhost/server.php',
	'uri' => 'http://localhost/');

	Without trace, you don't get responseheaders etc.
	Use trace, don't dump
*/

$gjSubj = 2;
$gjclient = '';
$result1 = '';

if($gjLocal) {
	gjShowErrors();
}
//td 2 is only one at this point
if($gjSubj == 2) {
	$options = array('location' => 'http://garyjohnsoninfo.info/gjsoap/hwsoapserver.php',
	'uri' => 'http://garyjohnsoninfo.info/gjsoap/',
	'soap_version' => SOAP_1_2,
	'trace' => 1);
} else {
	$options = array('location' => 'http://localhost/gjsoap/hwsoapserver.php',
	'uri' => 'http://localhost/gjsoap/',
	'trace' => 1);
}

// call SoapClient to make a connection

for($i=0; $i < GJRETRIES; $i++) {
    $gjclient = cSoapClient($options);
    if($gjclient === false) {
		sleep(GJSLEEPSECS);
	} else { break; }
}

if ($gjclient === false) {
	//we are hosed
	$to = 'gary_johnson_53@yahoo.com';
	$subject  = 'Error alert from SOAP';
	$msg = 'check the logs, error connecting to host';
	mailMe($gjLocal, $to, $subject, $msg);
	die ('cSoapClient Fatal error'."\r\n");
}

// make a soap request

for($i=0; $i < GJRETRIES; $i++) {
    $rreturn = cSoapRequest($gjclient);
    if($rreturn == 0) {
		sleep(GJSLEEPSECS);
	} else { break; }
}

if ($rreturn == 0) {
	//we are hosed
	$to = 'gary_johnson_53@yahoo.com';
	$subject  = 'Error alert from SOAPt';
	$msg = 'check the logs, error in soap request';
	mailMe($gjLocal, $to, $subject, $msg);
	die ('cSoapRequest Fatal error'."\r\n");
}


//destructive
//$gjclient = @new SoapClient("non-existent.wsdl",array("exceptions" => 1));
//$gjclient = new SoapClient("some.wsdl");


function cSoapClient($Optionsin) {
	//good
	try {
		$gjclient = new SoapClient(NULL, $Optionsin);
	} catch (SoapFault $fault) {
		echo "\n";
		echo 'cSoapClient Soap Error - faultcode: '.$fault->faultcode.' faultstring: '.$fault->faultstring;
		echo "\n";
		return false;
	}
return $gjclient;
}

function cSoapRequest ($gjclient) {

	try {
		// null var_dump($gjclient->__getTypes());
		// plain old function
		//$return = $gjclient->__soapCall("echoString",array("hello","world"));
		//echo 'The return: '.$return;

		//no functions when using service, SWAG its just for functions

		$gj1 = array('ngj1' => 'vgj1');

		//if new SoapParm : SoapClient::__call() expects parameter 2 to be array, object given
		//$soapparms = new SoapParam($gj1, "a");
		//$result1 = 		$gjclient->__call('hello',$soapparms);  //throws error no xml
		$result1 = 		$gjclient->__call('hello',$gj1);

		//$result3 = $gjclient->hell();
		echo "\n";

		//$gjFuncs = $gjclient->__getFunctions();

		//print_r($gjFuncs);
		//echo "\n";

		//this likes to run one call at a time
		//Soap Error - faultcode: HTTP faultstring: Error Fetching http headers
		//$who =$gjclient->register('me');
		//echo 'who: '.$who."\n";
		//echo "\n";

		//$result2	=$gjclient->add(10, 10); // // SoapClient->__call('add', Array)
		//echo 'rewsult2: '.$result2;
		//echo "\n";
	} catch (SoapFault $fault) {
		echo "\n";
		echo 'cSoapRequest Soap Error - faultcode: '.$fault->faultcode.' faultstring: '.$fault->faultstring;
		echo "\n";
		//print_r($fault);
		//echo "\n";
		//SOAP_Fault Object has a nice backtrace; however, its broken - recursive
		//trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
		return(false);
	}
if($result1 !== '') {
	echo "result1 : \n";
	//need to parse the result
	print_r($result1);

	echo "\n";
	//Warning: DOMDocument::loadXML(): Namespace prefix SOAP-ENV on Envelope is not defined in Entity
	$responseDoc = new DomDocument();
	$responseDoc->loadXML($result1);
	$errors = $responseDoc->getElementsByTagName('Errors');
	$result1 = $responseDoc->getElementsByTagName('string');

	print_r($result1);


}
return true;
}

$endTime=microtime(true);
$ET = $endTime - $startTime;

if($ET > .1) {
	echo "time elapsed : ".$ET."\n";
} else {
	echo "time elapsed less than a tenth of a second\n";
}
	echo "\n";

echo 'Option  == ' .$gjSubj. " 'trace' => 1 turned on\n";
echo "\n";

//echo "REQUEST HEADERS:" . $gjclient->__getLastRequestHeaders();
echo "\n";

//echo "RESPONSE HEADERS:" . $gjclient->__getLastResponseHeaders();
echo "\n";

//print_r("RESPONSE:" . $gjclient->__getLastResponse());
echo "\n";

/*
//Xml string is parsed and creates a SimpleXML object
$this->resp = simplexml_load_string($this->responseXml)

//Xml string is parsed and creates a DOM Document object
$responseDoc = new DomDocument();
$responseDoc->loadXML($responseXml);
//			$responseDoc->save("getsellerlist".$thisPage.".xml");

//get any error nodes

*/



	echo "\n";

exit('we are done');

?>