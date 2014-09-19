<?php
/*
hello world hwsoapserver.php
requires the libxml PHP extension --enable-libxml
The libxml extension is enabled by default, although it may be disabled with --disable-libxml .
*/


// set $gjLocal and $gjDebug to set up debugging


require_once 'includes/gj_utility.inc.php';
require_once 'includes/gj_soap.inc.php';

global $gjDebug;
global $gjXDebug;
global $gjLocal;
$gjLocal = gjAreLocal();
$gjDebug = true;  //for both set, do not comment out
$gjXDebug = false;

//set up server
//$GJBASE_URL = 'http://'.$_SERVER['SERVER_NAME'].'gjsoap'.'/';

if($gjLocal) {
    $GJBASE_URI = 'gjsoap/';

    if (!isset($GJBASE_URI)) {
      $GJBASE_URI = 'gjsoap/';
    }

	gjShowErrors();
	//when in non-wsdl mode  the uri option must be specified
	$options=array('uri'=>'http://localhost/gjsoap');
    //$gjwhere = 'http://localhost/garyjohnsoninfo.info/gjsoap/';
    $gjwhere = 'http://localhost/gjsoap/';
} else {
	$GJBASE_URL = 'http://'.$_SERVER['SERVER_NAME'].'gjsoap'.'/';

    if (!isset($GJBASE_URI)) {
    $GJBASE_URI =  $_SERVER['DOCUMENT_ROOT'].'gjsoap/';
    }

	$options=array('uri'=>'http://garyjohnsoninfo.info/gjsoap');
    $gjwhere = 'http://garyjohnsoninfo.info/gjsoap/';
	error_log('ss'.$_SERVER['SERVER_NAME'],0);
}

/**
 * Generate a simple SOAP response XML packing the $stringarray
 *
 * @param array $stringarray
 * @return string SOAP xml response
 */
function getXml($kvarray) {
$xml = '<?xml version="1.0" encoding="utf-8"?>
<SOAP-ENV:Envelope><SOAP-ENV:Body><SOAP-ENV:SReturn>';

    foreach($kvarray as $key => $value) {
        $xml .= "<string>$key : $value</string>";
    }

    $xml .= '</SOAP-ENV:SReturn></SOAP-ENV:Body></SOAP-ENV:Envelope>';
return $xml;
}

// really lame class for service
class MyService {
    public function add($x, $y) {
		error_log('MyService hello: add  x '.$x. ' y'. $y);
//td
		$myresponse = array('x + y' => 'fix me');
		$myresponse = array('add');
        return $x + $y;
    }
    public function register($who) {
		error_log('MyService hello: who '.$who);
		$myresponse = array('rkey' => 'rvalue');
        return getXml($myresponse);
    }

	public function hello($gj1) {
		error_log('MyService hello:');
		$hvalue = microtime(true);
		$myresponse = array('hkey' => $hvalue, 'argvalue' =>$gj1);
		return getXml($myresponse);
	}
}

// lame class to export all methods from with setClass
class MyAPI {
    private static $_count = 0;
    private $_MyInstance;
    protected $myprotected;
    public $arg1 = '';
	//public $responseBody;
    //no magic contructor  __construct($arg1)

	public function MyApi($arg1) {
    	self::$_count++;  //no this-> use self::$varname
		error_log('MYApi: ss construct MyAPI with:  '.$arg1);
	}

	public function hello() {
		error_log('MyAPI hello:');
		$myresponse = array('chello world');
		return getXml($myresponse);
	}
}
//
function echoString($inputString) {
    return $inputString;
}

//create a new SOAP server in non - WSDL mode
$server	= new SoapServer(NULL,$options);
// NG with functions and addFunction(SOAP_FUNCTIONS_ALL) you get all the php functions and everything else NG
// looks like you can addFunction or setClass, but you can't mix and match
//$server->addFunction("echoString");

//attach the API class to the SOAP Server
//$server->setClass('MyAPI','arg1 maybe a cert');

$server->setObject(new MyService());

//start the SOAP requests handler
$server->handle();

//$server->addFunction(SOAP_FUNCTIONS_ALL);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$server->handle();
} else {
	echo "This SOAP server can handle following functions:<br>";
	$functions = $server->getFunctions();
	foreach($functions as $func) {
		echo $func . "<br>";
	}
}

//nada nothing zip zilch wtf
//$definedVars = get_defined_vars(); // return empty if from here
//error_log('ss defined variable'. displaydefinedVariables($definedVars),0);

?>