<?php
/*
* PHP SOAP- How to create a SOAP Server and a SOAP Client
requires the libxml PHP extension.
--enable-libxml is	also required
The libxml extension is enabled by default, although it may be disabled with --disable-libxml .
*/

// lame API class
class MyAPI {
	function hello() {
	return "Hello";
	}
}


global $gjLocal;
require_once 'includes/gj_utility.inc.php';

$gjLocal = gjAreLocal();
if($gjLocal) {
	gjShowErrors();
	//when in non-wsdl mode	the	uri	option must	be specified
	$options=array('uri'=>'http://localhost/gjsoap');
} else {
	echo 'only local for today<br>';
	$options=array('uri'=>'http://garyjohnsoninfo.info/gjsoap');
	error_log($_SERVER['SERVER_NAME'],0);
}

//stop SOAP server
del $server;

?>