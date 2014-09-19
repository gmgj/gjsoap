<?php
/*
 * PHP SOAP - How to create a basic SOAP Server
 */

//a basic API class
class MyAPI {

    function hello() {
        return "I am a Hello";
    }

}
$hdr = file_get_contents("php://input");
if (strpos($hdr,'<s:Header>')===false) {
    $hdr = null;
} else {
    $hdr = explode('<s:Header>',$hdr);
    $hdr = explode('</s:Header>',$hdr[1]);
    $hdr = $hdr[0];
}

if($hdr === null) {
error_log($hdr);
}

//$srv = new SoapServer('Your_wsdl');
//$srv->setClass("ServiceClass",$hdr);
//$srv->handle();

//when in non-wsdl mode the uri option must be specified
$options=array('uri'=>'http://localhost/gjsoap');
//create a new SOAP server
$server = new SoapServer(NULL,$options);
//attach the API class to the SOAP Server
$server->setClass('MyAPI',$hdr);
//start the SOAP requests handler
$server->handle();
//the echo is just for demo purposes,
//when implementing a SOAP Client no echo must be present otherwise an error will be thrown
echo "SOAP Server started";
?>