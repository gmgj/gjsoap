<?php
//soapnotes.php
require_once 'includes/gj_utility.inc.php';
display_file_as_text('soapnotes.php');
exit();
?>
<html>
http://localhost/peardoc/docs/SOAP/example/

http://www.herongyang.com/Web-Services/PHP-SOAP-Server-Example-HelloServer.html
http://stackoverflow.com/questions/12490298/perfect-soap-wsdl-web-service-in-php

see http://php.net/manual/en/soapclient.soapclient.php for some nice examples

It took me longer than a week to figure out how to implement WSSE (Web Service Security) headers in native PHP SOAP.
 There are no much resource available on this, so thought to add this here for community benefit.

Step1: Create two classes to create a structure for WSSE headers

http://runnable.com/UmqmRWl_VPc8AACO/how-to-create-a-basic-soap-server-for-soapserver-and-php

check for xml in


class clsWSSEAuth {
          private $Username;
          private $Password;
        function __construct($username, $password) {
                 $this->Username=$username;
                 $this->Password=$password;
              }
}

class clsWSSEToken {
        private $UsernameToken;
        function __construct ($innerVal){
            $this->UsernameToken = $innerVal;
        }
}


Step2: Create Soap Variables for UserName and Password


$username = 1111;
$password = 1111;

//Check with your provider which security name-space they are using.
$strWSSENS = "http://schemas.xmlsoap.org/ws/2002/07/secext";

$objSoapVarUser = new SoapVar($username, XSD_STRING, NULL, $strWSSENS, NULL, $strWSSENS);
$objSoapVarPass = new SoapVar($password, XSD_STRING, NULL, $strWSSENS, NULL, $strWSSENS);
?>

Step3: Create Object for Auth Class and pass in soap var


$objWSSEAuth = new clsWSSEAuth($objSoapVarUser, $objSoapVarPass);

Step4: Create SoapVar out of object of Auth class


$objSoapVarWSSEAuth = new SoapVar($objWSSEAuth, SOAP_ENC_OBJECT, NULL, $strWSSENS, 'UsernameToken', $strWSSENS);


Step5: Create object for Token Class


$objWSSEToken = new clsWSSEToken($objSoapVarWSSEAuth);


Step6: Create SoapVar out of object of Token class


$objSoapVarWSSEToken = new SoapVar($objWSSEToken, SOAP_ENC_OBJECT, NULL, $strWSSENS, 'UsernameToken', $strWSSENS);


Step7: Create SoapVar for 'Security' node


$objSoapVarHeaderVal=new SoapVar($objSoapVarWSSEToken, SOAP_ENC_OBJECT, NULL, $strWSSENS, 'Security', $strWSSENS);


Step8: Create header object out of security soapvar


$objSoapVarWSSEHeader = new SoapHeader($strWSSENS, 'Security', $objSoapVarHeaderVal,true, 'http://abce.com');

//Third parameter here makes 'mustUnderstand=1
//Forth parameter generates 'actor="http://abce.com"'


Step9: Create object of Soap Client


$objClient = new SoapClient($WSDL, $arrOptions);


Step10: Set headers for soapclient object


$objClient->__setSoapHeaders(array($objSoapVarWSSEHeader));


Step 11: Final call to method


$objResponse = $objClient->__soapCall($strMethod, $requestPayloadString);



The HTTP body of the response has the wrong Content-Type.
The content is no XML at all, because the PHP script triggered a fatal error, or an uncatched exception, or simply die()d.
The content contains PHP error output like notices, warnings etc.
How to see what it is?

print/echo content
rik's answer too
mistake (eg I was currently having this error because of a miswritten filename in an include, generating an include error instead of executing the script...)
bad parameter in SOAP server
not the same compression level both sides (if compression used)

a soap request

POST /InStock HTTP/1.1
Host: www.example.org
Content-Type: application/soap+xml; charset=utf-8
Content-Length: nnn

<?xml version="1.0"?>
<soap:Envelope
xmlns:soap="http://www.w3.org/2001/12/soap-envelope"
soap:encodingStyle="http://www.w3.org/2001/12/soap-encoding">

The SOAP response:

HTTP/1.1 200 OK
Content-Type: application/soap+xml; charset=utf-8
Content-Length: nnn

<?xml version="1.0"?>
<soap:Envelope
xmlns:soap="http://www.w3.org/2001/12/soap-envelope"
soap:encodingStyle="http://www.w3.org/2001/12/soap-encoding">

<soap:Body xmlns:m="http://www.example.org/stock">
  <m:GetStockPriceResponse>
    <m:Price>34.5</m:Price>
  </m:GetStockPriceResponse>
</soap:Body>

</soap:Envelope>

<soap:Body xmlns:m="http://www.example.org/stock">
  <m:GetStockPrice>
    <m:StockName>IBM</m:StockName>
  </m:GetStockPrice>
</soap:Body>

</soap:Envelope>

http://www.nusphere.com/kb/phpmanual/function.soap-soapserver-setclass.htm

PEAR

NuSOAP is a rewrite of SOAPx4, provided by NuSphere and Dietrich Ayala.

I have moved the source around from pear to make my life easier
examples to gjsoap
some stuff from tests to examples test.utitlity.php

SOAP_FAULT lools to be recursive

$backtrace =& PEAR::getStaticProperty('SOAP_Fault', 'backtrace');
$backtrace = false;

PEAR\SOAP\Fault.php

class SOAP_Fault extends PEAR_Error
{
    /**
     * Constructor.
     *
     * @param string $faultstring  Message string for fault.
     * @param mixed $faultcode     The faultcode.
     * @param mixed $faultactor
     * @param mixed $detail        @see PEAR_Error
     * @param array $mode          @see PEAR_Error
     * @param array $options       @see PEAR_Error
     */
    function SOAP_Fault($faultstring = 'unknown error', $faultcode = 'Client',
                        $faultactor = null, $detail = null, $mode = null,
                        $options = null)
    {
        parent::PEAR_Error($faultstring, $faultcode, $mode, $options, $detail);
        if ($faultactor) {
            $this->error_message_prefix = $faultactor;
        }
    }
}


$params = array('receiver'=>array('name'=>array('name_type'=>'M','given_name'=>'SAUL','paternal_name'=>'AQUINO', 'maternal_name'=>'CONCEPCION')));
$client->ReceiveMoneyPay($params);

Test script:
---------------
//Server
$Server = new SoapServer(NULL, Array('uri' => 'urn:service our_service', 'soap_version' => SOAP_1_2));
$Service = new SOAP_Service($uid);
Server->setObject($Service);
$Server->handle();

//Client
 $Client = new SoapClient(null, array(
        'location'     => 'https://someaddress.com/server.php',
        'uri'          => "urn:service our_service",
        'soap_version' => SOAP_1_2,
        'login'        => '****',
        'password'     => '****',
        'connection_timeout' => 600,
        'exceptions'  => 1,
        'keep_alive'  => 1,
        'trace'       => 1,
    ));

    var_dump($Client->command());



How is a phpt test is used?
When a test is called by the run-tests.php script it takes various parts of the phpt file to name and
create a .php file. That .php file is then executed. The output of the .php file is then compared to a
different section of the phpt file. If the output of the script "matches" the output provided in the phpt
script - it passes.



/

/**
 * Parse the XML string using SOAP_Parser.
 *
 * @param string $xml The xml string to be parsed
 * @return mixed Parsed result for the xml string.
 */
function parseXml($xml)
{
    $response = new SOAP_Parser($xml, 'UTF-8', $v = null);

    // This still looks normal.
    $return = $response->getResponse();
    // print_r($return);

    // This loses the first two items for $i > 3 and
    // has an unexpected key 'string' for $i == 3.
    $decoded = $response->_decode($return);
    //print_r($decoded);

    return $decoded->return;
}

//  Fatal error: Class 'SOAP_Value' not found in F:\bit5411\apps\gjsoap\htdocs\hwsoapclient.php on line 56
	$p = array(new SOAP_Value('inputString', 'string', 'hello world'));
	echo $gjclient->_generate('echoString', $p);

/*
$foo = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<SOAP-ENV:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
<SOAP-ENV:Body>
<namesp1:echoStringArrayResponse xmlns:namesp1="http://soapinterop.org/">
<return xsi:type="SOAP-ENC:Array" SOAP-ENC:arrayType="xsd:string[2]">
<item xsi:type="xsd:string">good</item>
<item xsi:type="xsd:string">bad</item>
</return>
</namesp1:echoStringArrayResponse>
</SOAP-ENV:Body>
</SOAP-ENV:Envelope>
EOF;
*/

/*
http://sourceforge.net/projects/nusoapforphp53/?source=recommended
http://sourceforge.net/projects/soapui/?source=recommended
*/


/*
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)
? $HTTP_RAW_POST_DATA : ?;
$server->service($HTTP_RAW_POST_DATA);
http://greatgandhi.wordpress.com/2009/11/25/create-a-php-webservice-in-5min-using-php-soap-and-wsdl-technology-nusoap/
*/


//HTTP/1.1 200 OK
//Content-Type: application/soap+xml; charset=utf-8
//Content-Length: nnn
$foo = <<< EOF
<?xml version="1.0" encoding="UTF-8"?>

<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
xmlns:ns1="http://localhost/gjsoap"
xmlns:xsd="http://www.w3.org/2001/XMLSchema"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/"
SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
<SOAP-ENV:Body>
<ns1:helloResponse>
hello
</ns1:helloResponse>
</SOAP-ENV:Body>
</SOAP-ENV:Envelope>

EOF;



For those (like me) coming from other SOAP frameworks and getting confused:

- A PHP SOAP server application created using the SoapServer class can not be used as a standalone SOAP server.
It needs an HTTP server to receive SOAP requests, which must run a PHP engine to execute the PHP SOAP server script as a CGI.

- For this reason, there are no settings in PHP that control the Interface/Port under which the SOAP server will wait for requests - it is the HTTP server who is responsible for that.

- The "uri" parameter is an "id value", used as the namespace for the SOAP response. It is only required if no WSDL file is used (that contains this setting), i.e. "wsdl" is set to NULL. It does _not_ control the Hostname/Port under which the HTTP server will be reachable for requests.

Be careful with SOAP_FUNCTIONS_ALL, as it adds ALL availiable PHP functions to your server.

This can be a potential security threat, imagine clients doing this:

echo $client->file_get_contents("c:\\my files\\my_passwords.doc");

And voila, they have the contents of your file my_passwords.doc.

(PHP 5 >= 5.2.0)
SoapServer::setObject  Sets the object which will be used to handle SOAP requests

Description ¶

public void SoapServer::setObject ( object $object )
This sets a specific object as the handler for SOAP requests, rather than just a class as in SoapServer::setClass().

Parameters ¶

object
The object to handle the requests.

SOAP Version 1.2

Latest version of SOAP Version 1.2 specification: http://www.w3.org/TR/soap12

SOAP and PHP in 2014

The SOAP stack is generally regarded as an embarrassing failure these days.  Tim Bray

http://www.whitewashing.de/2014/01/31/soap_and_php_in_2014.html

bool use_soap_error_handler ([ bool $handler = true ] )

C:\phpsrc\ext\soap\php_packet_soap.c
#include "php_soap.h"
looks like we got no XML document
/* SOAP client calls this function to parse response from SOAP server */
int parse_packet_soap(zval *this_ptr, char *buffer, int buffer_size, sdlFunctionPtr fn, char *fn_name, zval *return_value, zval *soap_headers TSRMLS_DC)
{
	char* envelope_ns = NULL;
	xmlDocPtr response;
	xmlNodePtr trav, env, head, body, resp, cur, fault;
	xmlAttrPtr attr;
	int param_count = 0;
	int soap_version = SOAP_1_1;
	HashTable *hdrs = NULL;

	ZVAL_NULL(return_value);

	/* Response for one-way opearation */
	if (buffer_size == 0) {
		return TRUE;
	}

	/* Parse XML packet */
	response = soap_xmlParseMemory(buffer, buffer_size);

	if (!response) {
		add_soap_fault(this_ptr, "Client", "looks like we got no XML document", NULL, NULL TSRMLS_CC);
		return FALSE;
	}


where is the calls to check which soap version

It is really flaky about throwing errors here
Soap Error - faultcode: Client faultstring: looks like we got no XML document

A good flush would be good


restart local server, looks good from local to gary

processing started :Mon, 04 August 2014 19:02:06 America/New_York
time elapsed in microtime (to thousands of a second) :0.30201601982117
Option  == 2 'trace' => 1 turned on
This Server Name localhost
REQUEST HEADERS:POST /gjsoap/hwsoapserver.php HTTP/1.1
Host: garyjohnsoninfo.info
Connection: Keep-Alive
User-Agent: PHP-SOAP/5.4.11
Content-Type: text/xml; charset=utf-8
SOAPAction: "http://garyjohnsoninfo.info/gjsoap/#hello"
Content-Length: 508

RESPONSE HEADERS:HTTP/1.1 200 OK
Server: nginx/1.6.0
Date: Mon, 04 Aug 2014 23:02:09 GMT
Content-Type: text/xml; charset=utf-8
Content-Length: 741
Connection: keep-alive
X-Powered-By: PHP/5.4.29
Vary: Accept-Encoding,User-Agent
RESPONSE:
<?xml version="1.0" encoding="utf-8"?>
<SOAP-ENV:Envelope><SOAP-ENV:Body><SOAP-ENV:SReturn><string>world</string></SOAP-ENV:SReturn></SOAP-ENV:Body></SOAP-ENV:Envelope>
result1 :
worldwe are done

 Easy to trace peer-to-peer communication with
reliable request/reply and publish/subscribe
messaging patterns.
 Synchronous and asynchronous communication
 Quality of Service (QoS): timeout management,
message queues and priorities, various thread
management policies.
 Small library size, low memory and resource usage.
 Certain performance characteristics (described later)
 No, or only a few, external dependencies that can be
linked with an application, preferably no need for
additional services (e.g. brokers, global servers,
daemons).
 Open source, with a license allowing to redistribute
our product further; good documentation, and
support from a large active community.
 Simple, easy to learn and use API.
The CMW team evaluated several market recognized
middleware products. A short description of each product
is provided below, including a general assessment and
results of tests. Detailed performance results and other
quantitative measurements are gathered and presented in
the next paragraph.
In line with the requirements the following middleware
standards and protocols were of no interest: XML-based
protocols (e.g. SOAP, XMPP), Stomp, P2P (FastTrack,
BitTorrent), MPI, MQTT (rsmb, Mosquitto) nor
WebSphere MQ.
The Current Solution: omni

SOAP Extension in PHP 5.3.1
does support RPC method based Web services defined in WSDL 1.1 with SOAP 1.2 binding.

<?php
# Reservation_SOAP12_Client.php
# Copyright (c) 2009 by Dr. Herong Yang, herongyang.com
# All rights reserved

#- Loading the WSDL document
   $server = "http://www.herongyang.com/Service/";
   $wsdl = $server . "Reservation_WSDL_11_SOAP_12_Document.wsdl";
   $client = new SoapClient($wsdl,
      array('trace' => TRUE, 'soap_version' => SOAP_1_2));

#- Creating the XML document
   $xml = <<<EOT
<hy:Reservation xmlns:hy="http://www.herongyang.com/Service/">
  <Member>Herong Yang</Member>
  <ItemList>
    <Item>Java Web Services</Item>
    <Item>SOAP Programming</Item>
  </ItemList>
</hy:Reservation>
EOT;
   $body = new SoapVar($xml,XSD_ANYXML);

#- Calling the service method
   $result = $client->Reservation($body);

#- Showing the request and reponse
   print $client->__getLastRequest()."\n";
   print $client->__getLastResponse()."\n";
?>



The SOAP processing model describes a distributed processing model, its participants, the SOAP nodes, and how a SOAP receiver processes a SOAP message. The following SOAP nodes are defined:

SOAP sender – a SOAP node that transmits a SOAP message.
SOAP receiver – a SOAP node that accepts a SOAP message.
SOAP message path – the set of SOAP nodes through which a single SOAP message passes.
Initial SOAP sender (Originator) – the SOAP sender that originates a SOAP message at the starting point of a SOAP message path.
SOAP intermediary – a SOAP intermediary is both a SOAP receiver and a SOAP sender and is targetable from within a SOAP message. It processes the SOAP header blocks targeted at it and acts to forward a SOAP message towards an ultimate SOAP receiver.
Ultimate SOAP receiver – the SOAP receiver that is a final destination of a SOAP message. It is responsible for processing the contents of the SOAP body and any SOAP header blocks targeted at it. In some circumstances, a SOAP message might not reach an ultimate SOAP receiver, for example because of a problem at a SOAP intermediary. An ultimate SOAP receiver cannot also be a SOAP intermediary for the same SOAP message.

When you get errors like:
"Fatal error: Uncaught SoapFault exception: [HTTP] Error Fetching http headers in"
after a few (time intensive) SOAP-Calls, check your webserver-config.

Sometimes the webservers "KeepAlive"-Setting tends to result in this error. For SOAP-Environments I recommend you to disable KeepAlive.

Hint: It might be tricky to create a dedicated vhost for your SOAP-Gateways and disable keepalive just for this vhost because for normal webpages Keepalive is a nice speed-boost.
