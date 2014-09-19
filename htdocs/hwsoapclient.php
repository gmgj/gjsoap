<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>which client</title>
</head>
<body>
<pre>
running client on local and server on local does not work
running client on server and server on local does not work
running client on local and sever on garyjohnsoninfo does work
if client error, it works best if you stop and start browser and your local server

To run from garyjohnsoninfo.info using apache for html transport
1) do show source (from prior menu) and cut the file hwsoapclient.php from the page
2) set it up so you can access if from your local or other server
3) run it with option 2 (the only one at this point)
need a reset function, server flush, etc

<?php
echo 'we are on Server Name '.$_SERVER['SERVER_NAME'].'<br>';
?>
</pre>


<form style="margin:2em;" name="sfm" id="sfm" action="" method="post">
<label class="buttonNgrey" for="gjwhich">Enter 2 for soap server on garyjohnsoninfo</label>
<br>
<input class="buttonNgrey" type="input" required name="gjwhich" id="gjwhich" value="2" maxlength="1" style='width:1em'>

<input type="hidden" name="gjwhichAction" value="gmail">
<input class="buttonNgrey" type="Submit" id="submit1" value="Submit" style='width:5em'>
</form>

<?php
/*
hello world hwsoapclient.php

looks like we got no XML document
http://lxr.php.net/xref/PHP_TRUNK/ext/soap/php_packet_soap.c

*/
require_once 'includes/gj_utility.inc.php';
require_once 'includes/gj_soap.inc.php';

if (!(isset($_POST) && array_key_exists("gjwhich",$_POST))) {
	error_log( "First Pass");
} else {
$ip=$_SERVER['REMOTE_ADDR'];
$gjErr = false;
$msg1 = "";

$gjSubj = htmlentities($_POST['gjwhich']);

if (!ctype_digit($gjSubj)) {
	$gjErr = true;
	$msg1 .= $gjSubj." Is not a valid value for which E1<br>";
} elseif ($gjSubj != 2) {
	$gjErr = true;
	$msg1 .= $gjSubj." Is not a valid value for which E2 <br>";
} else {
	echo 'processing started :'.date("D, d F Y H:i:s e"), "<br>";
	//gmdate(DATE_RFC822)
	$startTime=microtime(true);
	//start a timer , check on returns
}

if ( $gjErr || $msg1 != "") {
	echo 'Error : '.$msg1 .'<br>';
	exit();
}


global $gjDebug;
global $gjXDebug;
global $gjLocal;
$gjLocal = gjAreLocal();
$gjDebug = true;  //for both set, do not comment out
$gjXDebug = false;
/*
destructive test if Invalid server location
err: HTTP msg: Not Found
	$options = array('location' => 'http://localhost/server.php',
	'uri' => 'http://localhost/');

	Without trace, you don't get responseheaders etc.
	Use trace, don't dump
*/

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


//destructive
//$gjclient = @new SoapClient("non-existent.wsdl",array("exceptions" => 1));
//$gjclient = new SoapClient("some.wsdl");

//good
$gjclient = new SoapClient(NULL, $options);

$result1 ='';
try {
	// null var_dump($gjclient->__getTypes());
	// plain old function
	//$return = $gjclient->__soapCall("echoString",array("hello","world"));
	//echo 'The return: '.$return;

	//no functions when using service, SWAG its just for functions
	//$gjFuncs = $gjclient->__getFunctions();

	$gj1 = array('ngj1' => 'vgj1');

	//if new SoapParm : SoapClient::__call() expects parameter 2 to be array, object given
	//$soapparms = new SoapParam($gj1, "a");
	//$result1 = 		$gjclient->__call('hello',$soapparms);  //throws error no xml
	$result1 = 		$gjclient->__call('hello',$gj1);

	//$result3 = $gjclient->hell();

} catch (SoapFault $fault) {
	echo "<pre style='margin:2em;'>";
	echo 'Soap Error - faultcode: '.$fault->faultcode.' faultstring: '.$fault->faultstring;
	echo '<br>';
	print_r($fault);
	echo '</pre>';
	//SOAP_Fault Object has a nice backtrace; however, its broken - recursive
	//trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
}

//usleep(2000000);


//print_r($gjFuncs);

//this likes to run one call at a time
//$who =$gjclient->register($ip);
//echo 'who: '.$who;

//$result2	=$gjclient->add(10, 10); // // SoapClient->__call('add', Array)
//echo 'rewsult2: '.$result2;

$endTime=microtime(true);
$ET = $endTime - $startTime;


echo "<pre style='margin:2em;'>";
if($ET > .1) {
	echo "time elapsed  :".$ET.'<br>';
} else {
	echo "time elapsed less than a tenth of a second<br>";
}
echo 'Option  == ' .$gjSubj. " 'trace' => 1 turned on<br>";
echo 'This Server Name '.$_SERVER['SERVER_NAME'].'<br>';
echo "REQUEST HEADERS:" . $gjclient->__getLastRequestHeaders();
echo "RESPONSE HEADERS:" . $gjclient->__getLastResponseHeaders();
print_r("RESPONSE:" . $gjclient->__getLastResponse());
if($result1 !== '') {
	echo 'result1 : <br>';
	print_r($result1);
	echo '<br>';
}
exit('we are done');
echo '</pre>';
echo '<hr>';
} // end else
?>


</body>
</html>