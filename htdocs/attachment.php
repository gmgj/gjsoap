<?php
/**
 * @category Web Services
 * @package SOAP
 MIME messages are unsupported, the Mail_Mime package is not installed
 */


global $gjLocal;
global $gjDebug;
$gjDebug = false;  //set, do not comment out
require_once 'includes/gj_utility.inc.php';

$gjLocal = gjAreLocal();

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




require_once("SOAP/Client.php");

//$backtrace =& PEAR::getStaticProperty('SOAP_Fault', 'backtrace');
//$backtrace = false;


//$where = dirname(dirname(__FILE__));
//echo $where; C:\php\pear\docs\SOAP
require_once 'test.utility.php';

//require_once("SOAP/test/test.utility.php");
require_once("SOAP/Value.php");

$filename = 'attachment.php';
$v =  new SOAP_Attachment('test','text/plain',$filename);
$methodValue = new SOAP_Value('testattach', 'Struct', array($v));

/*
gj domain.com soapinterop etc need valid servers etc
*/

$client = new SOAP_Client('mailto:user@domain.com');
# calling with mime
$resp = $client->call('echoMimeAttachment',array($v),
                array('attachments'=>'Mime',
                'namespace'=>'http://soapinterop.org/',
                'from'=>'user@domain.com',
                'host'=>'smtp.domain.com'));
echo "<pre style='margin:2em;'>";
print $client->wire."\n\n\n";
print_r($resp);
echo "</pre>";
//# calling with DIME
//$resp = $client->call('echoMimeAttachment',array($v));
//# DIME has null spaces, change them so we can see the wire
//$wire = str_replace("\0",'*',$client->wire);
//print $wire."\n\n\n";
//print_r($resp);
?>