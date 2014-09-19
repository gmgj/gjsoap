<?php

/**
 *
 * SOAP SERVER v.0.1
 *
 * @file
 * Provides a simple SOAP server for demo purposes
 *
 */


require_once '../includes/gj_utility.inc.php';
require_once '../includes/gj_soap.inc.php';
require 'service_functions.php';

global $gjDebug;
global $gjXDebug;
global $gjLocal;
$gjLocal = gjAreLocal();
$gjDebug = true;  //for both set, do not comment out
$gjXDebug = false;

$server = new SoapServer("simpleO.wsdl");

$server->setClass('MyAPI','arg1 maybe a cert');
$server->AddFunction("getHello");
$server->AddFunction("getGoodbye");

$server->handle();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$server->handle();
} else {
	echo "This SOAP server can handle following functions:<br>";
	$functions = $server->getFunctions();
	foreach($functions as $func) {
		echo $func . "<br>";
	}
}
?>


