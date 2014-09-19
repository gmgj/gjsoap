<?php
/*

Notes file for RSI

http://pear.php.net/package/XML_Util

PHAR
The phar extension provides a way to put entire PHP applications into a single file called a "phar" (PHP Archive).
Phar archives can be executed by PHP as easily as any other file, both on the commandline and from a web server.

CI path stuff


phar.unit.bat
echo on
%~dp0php.exe %~dp0phpunit.phar %*

if php in search, it works


apache2 httpd.conf
apache2 access.log
apache2 error.log
php error.log

C:\Windows\System32\drivers\etc\hosts
MYSQL error
mysql\data\.err or whatever


no docblock, no phpdocumentor syntax


whats the function for the headers
 'scheme' => string 'http' (length=4)
  'host' => string 'video.google.com' (length=16)
  'path' => string '/videoplay' (length=10)
  'query' => string 'docid=-5137581991288263801&q=loose+change' (length=41)



*/

/*
testing
&rsaquo; What is unit testing? What are the benefits of unit testing?
The premise of unit testing is that you define tests to confirm that particular bits of code work
as needed. Here are a few of the benefits of unit testing:

Tests will minimize bugs (this is the most obvious benefit).
Tests can help you improve your design.
Tests can assist in creating documentation for your code.
You are less likely to break code and introduce errors as you make changes down the line.

What are some of the properties that unit tests should exhibit?
I write tests that call the use code in the most common way and with exception condtions.
I continually add to and expand upon the test code.


&rsaquo; What is TDD?
test-driven development (TDD).
you define your tests and then write code that passes those tests.



&rsaquo; What are assertions?
Confirm that this is the case.
assertContains( $needle, $haystack);
Because this is an assertion, this test would fail if the needle is not found within the haystack.
This is functionally equivalent to
if (!in_array( $needle, $haystack)) {
     echo 'The test has failed!';
}

How do you invoke the assertion methods within the test class?
&rsaquo;How do you create a test suite?
Begin a new PHP script in your text editor or IDE, to be named XXXXXX.php

you create a test suite by extending the PHPUnit_Framework_TestCase class:

class SomeClassTest extends PHPUnit_Framework_TestCase { }
Conventionally, you’ll name the new class a combination of the name of the class being tested,
followed by Test.


&rsaquo; How do you create a test case (a suite of tests) using PHPUnit?
         How do you create an individual test?

Within this class, create one new public method for each test.
Each method’s name should start with test: function testSomething()


&rsaquo; What is profiling? What is webgrind?
Profiling is the process of analyzing a script to see where there may be performance problems: slow bits of code and process bottlenecks.

Standard PHP Library (SPL)

names = new SplStack();
// Add items:
$names-> push(' Lucian');
$names-> push(' Priscilla');
$names-> push(' Travis');
$names-> push(' Greta');
$names-> pop(); // Greta
Similar to the stack is the queue, implemented in SPL as SplQueue.

What is an iterator? (See page 273.)
Iterator is a design pattern that makes it possible to access the components of any kind
of complex data structure using a loop.
Iterators are absolutely, positively friggin AWESOME.

What are some of the new data structures added in the SPL?
splFixedArray - fast
splStack - LIFO - its done for you
splQueue - FIFO - its done for you
What advantages are there in using them? (See page 278.)
class Department implements Iterator, Countable {
    // Attributes.    
    // Other methods.    
    function count() {
         return count( $ this->_employees);    
    }
} // End of Department class.


*/


/*
sql
mysql -h {host_name} -u {user_name} -p{password} -Ne "select distinct concat( \"SHOW GRANTS FOR '\",user,\"'@'\",host,\"';\" ) from user;" mysql | mysql -h {host_name} -u {user_name} -p{password} | sed 's/\(GRANT .*\)/\1;/;s/^\(Grants for .*\)/## \1 ##/;/##/{x;p;x;}'

mysqldump ... --routines --all-databases > backup.sql

SELECT * FROM mysql.user;

mysqldump db_name table_name > table_name.sql

*/

/*
 Some of the forms of redirection for the C shell family are:

> Redirect standard output

>& Redirect standard output and standard error

< Redirect standard input

>! Redirect standard output; overwrite file if it exists

>&! Redirect standard output and standard error; overwrite file if it exists

| Redirect standard output to another command (pipe)

>> Append standard output

>>& Append standard output and standard error
*/


/*
Complex services are what have been historically known as true Web services (as opposed to the generic term). In a complex service, the client is able to dynamically discover and use the service. For example, the server may use Web Services Description Language (WSDL) to describe the service provided. That WSDL document is then readable by clients tapping into the service. Complex Web services often transmit data using custom, non-scalar types. This might require a protocol such as Simple Object Access Protocol (SOAP). This means that instead of just transmitting, say, plain text or XML between the client and the server, the server may send back data in an agreed-upon object format. As you can tell, complex Web services tend to have tighter integration between the client and the server. And there may be several iterations of communication over the course of a transaction.

Conversely, simple Web services are stateless: just a basic request-response dynamic. The client makes standard requests in the hopes that the server understands that request and is able to reply. These are also known as application programming interface (API)-based services, where the developer has to find the documentation that explains how to use the service. All of the examples in this chapter have been of this type. A popular type of simple service is called REST-ful, short for Representational State Transfer (REST). These are normally HTTP requests, with data often being passed to the service, which will in turn impact the data returned by the service. For example, an IP address and a returned data format are sent to the IP geolocation service, which then returns information in the given format.
*/

/*
&rsquo; What line does XML data begin with?
An XML document contains two parts:
&rsquo; The prolog or XML declaration
&rsquo; The data The XML prolog is the first line of every XML file and should be in the form

The prolog indicates the XML version and, sometimes, the text encoding or similar attributes: Click here to view code image <? xml version =" 1.0" encoding =" utf-8"? > There are actually two versions of XML 1.0 and 1.1 but the differences

&rsquo; What are the rules for XML tags?
The XML rules for elements insist on the following:
&rsquo; XML tags must be balanced in that they open and close (for every < tag > there must be a </ tag >).
&rsquo; Elements can be nested but not intertwined. HTML will let you get away with a construct like < strong > < em > Soul Mining </ strong > </ em >, but XML will not.
tag names, they are case-sensitive. You can use letters, numbers, and some other characters, but tag names cannot contain spaces or begin with the letters xml. They can only begin with either a letter or the underscore.


Is XML case-sensitive or case-insensitive?
case-sensitive
&rsquo; What are the rules for attributes?
An element, as already described, has both tags and data.
< tag attribute_name =" value" > data </ tag >
XML elements can have an unlimited number of attributes;
the only restriction is that each attribute must have a value.
You can use either single or double quotes for quoting your attribute values,
but you must use quotes and you should be consistent about which type you use.

&rsquo; If an element does not require a closing tag, what can you do instead?
Attributes are often used with empty elements.
An empty element is one that doesnt encapsulate any data.
As an HTML example, < img /> is an empty element.
You use a /> to end the element, rather than the end tag

&rsquo; How do you associate a DTD with an XML document (there are two answers)?
XML files primarily contain data, as youve already seen in the first three scripts.
That data can also be associated with a schema, which is a guide for the XML documents contents.
Schemas are optional, but if provided, can be used to ensure that the XML data is valid.
A schema can be represented using two approaches:

&rsquo; DTD, a Document Type Definition

&rsquo; XML Schema

To associate a DTD with an XML file, a reference line is placed after the prolog but before the data itself:


&rsquo; How do you define elements and attributes using DTD?

This process is called document modeling, because you are creating a paradigm for how your XML data should be organized. Defining elements A DTD defines every element and attribute thats to be used in your markup language. The syntax for defining an element is <! ELEMENT name TYPE > where name is the name of the new tag and it will contain content of type TYPE.


<! ELEMENT name TYPE > where name is the name of the new tag and it will contain content of type TYPE.
Element examples with Types

<! ELEMENT name (# PCDATA) >
<! ELEMENT size (# CDATA) >
<! ELEMENT price (Any) >
<! ELEMENT picture EMPTY >

<! ELEMENT product (name, size, price, picture) >
? optional (zero or one)
+ at least one
* Zero or more
| or

<! ATTLIST element_name attr_name   attr_type   attr_description >
<! ATTLIST picture      filename    NMTOKEN     #REQUIRED >

Element Attribute types

CDATA       General Text
NMTOKEN     Name Token (string without white space)
NMTOKENS    Several Name Tokens
ID          Unique Identifier

Description
#REQUIRED
#IMPLIED
#FIXED


When do I use elements and when do I use attributes for presenting bits of information?

    If the information in question could be itself marked up with elements, put it in an element.
    If the information is suitable for attribute form, but could end up as multiple attributes of the same name on the same element, use child elements instead.
    If the information is required to be in a standard DTD-like attribute type such as ID, IDREF, or ENTITY, use an attribute.
    If the information should not be normalized for white space, use elements. (XML processors normalize attributes in ways that can change the raw text of the attribute value.)

My Favorite Way

I like to store data in child elements.

The following three XML documents contain exactly the same information:

A date attribute is used in the first example:
<note date="12/11/2002">
  <to>Tove</to>
  <from>Jani</from>
  <heading>Reminder</heading>
  <body>Don't forget me this weekend!</body>
</note>

A date element is used in the second example:
<note>
  <date>12/11/2002</date>
  <to>Tove</to>
  <from>Jani</from>
  <heading>Reminder</heading>
  <body>Don't forget me this weekend!</body>
</note>

An expanded date element is used in the third: (THIS IS MY FAVORITE):
<note>
  <date>
    <day>12</day>
    <month>11</month>
    <year>2002</year>
  </date>
  <to>Tove</to>
  <from>Jani</from>
  <heading>Reminder</heading>
  <body>Don t forget me this weekend!</body>
</note>

&rsquo; What are entities and why are they required in XML data?
Some characters cannot be used in XML data, as they cause conflicts.
Instead, a character combination is used, known as the entity version of the problematic character.
Entities always start with the ampersand (&) and end with the semicolon

example &amp;amp;


&rsquo; How does XSD differ from DTD?
Unlike DTD, XSD is written in XML.
XML Schema Document (XSD). Version 1.1 of XSD

XML Schema is a more powerful and complex tool for defining what constitutes acceptable XML data. For example, whereas
DTD is vague as to an elements type most come down to character data of some sort XML Schema can require that an
element contain an integer, a string, a decimal, a valid country code, and more.

&rsquo; How do you associate an XSD with an XML document (again, two answers)?

To add XSD to an XML document, use the schema element (after the prolog but before the data).
This is the syntax for specifying the XSD definitions within the schema element:

    <xs:schema xmlns:xs="http://www.w3.org/2001/XMLSchema">
          <!-- Schema definitions go here -->
    </xs:schema>
<!-- Start XML Data -->
Here is the syntax for specifying a store element definition in an external .xsd document:

    <?xml version="1.0" encoding="utf-8"?>
    <store xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="myxsdfile.xsd">
<!-- Start your XML data here -->


&rsquo; What are the two types of XML parsers demonstrated in this chapter?
    event-based parsers (sometimes called streaming parsers)
    tree-based parsers, also known as DOM-based parsers.
How do they differ?


&rsquo; An event-based API reports parsing events (such as the start and end of elements) directly to an application through
callbacks, and does not usually build an internal tree. The application implements handlers to deal with the different
events, much like handling events in a graphical user interface. SAX (Simple API for XML) is the best known example of
such an API. Expat is another commonly used event-based XML parser.
An event-based API provides a simpler, lower-level
access to an XML document: you can parse documents much larger than your available system memory, and you can construct
your own data structures using your callback event handlers. An event-based parser is data-centric in that it
sequentially parses parts of a document based on specific events.


&rsquo; On the other hand, a tree-based API maps an XML
document into an internal tree structure, then allows an application to navigate that tree. Because the entire document
is loaded into memory, tree-based APIs normally put a great strain on system resources, especially if the document is
large. A DOM-based parser is suitable for XML data that is to be read repeatedly or out of sequence. SimpleXML, added in
PHP 5, is an example of a DOM-based parser.

F:\bit5411\apps\gjsoap\htdocs\chirpXML.php
*/


function print_r_xml($mixed) {
    // capture the output of print_r
    $out = print_r($mixed, true);

    // Replace the root item with a struct
    // MATCH : '<start>element<newline> ('
    $root_pattern = '/[ \t]*([a-z0-9 \t_]+)\n[ \t]*\(/i';
    $root_replace_pattern = '<struct name="root" type="\\1">';
    $out = preg_replace($root_pattern, $root_replace_pattern, $out, 1);

    // Replace array and object items structs
    // MATCH : '[element] => <newline> ('
    $struct_pattern = '/[ \t]*\[([^\]]+)\][ \t]*\=\>[ \t]*([a-z0-9 \t_]+)\n[ \t]*\(/miU';
    $struct_replace_pattern = '<struct name="\\1" type="\\2">';
    $out = preg_replace($struct_pattern, $struct_replace_pattern, $out);
    // replace ')' on its own on a new line (surrounded by whitespace is ok) with '</var>
    $out = preg_replace('/^\s*\)\s*$/m', '</struct>', $out);

    // Replace simple key=>values with vars
    // MATCH : '[element] => value<newline>'
    $var_pattern = '/[ \t]*\[([^\]]+)\][ \t]*\=\>[ \t]*([a-z0-9 \t_\S]+)/i';
    $var_replace_pattern = '<var name="\\1">\\2</var>';
    $out = preg_replace($var_pattern, $var_replace_pattern, $out);

    $out =  trim($out);
    $out='<?xml version="1.0"?><data>'.$out.'</data>';

    return $out;
}

function gjpath() {

chdir('./');
echo PHP_EOL;
echo 'realpath '.realpath('./../../').PHP_EOL;
echo 'dirname '.dirname(__FILE__).PHP_EOL;

echo 'realpath '.realpath('/windows/system32').PHP_EOL;
echo dirname($_SERVER['SCRIPT_FILENAME']).PHP_EOL;

/*
$path_parts = pathinfo('/htdocs/').PHP_EOL;

echo $path_parts['dirname'], "\n".PHP_EOL;
echo $path_parts['basename'], "\n".PHP_EOL;
echo $path_parts['extension'], "\n".PHP_EOL;
echo $path_parts['filename'], "\n".PHP_EOL; // since PHP 5.2.0
*/
}


function lamda() {
$hello = function ($who)
{
    echo "<p>echo of a p - Hello I am an anonymous function (a lambda), used as a closure. , $who </p>";
};
$hello('World!');
}

lamda();

echo 'get_include_path()'.get_include_path().PHP_EOL;

lamda();

echo PHP_EOL;
if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
    echo 'echo - I am at least PHP version 5.4.0, my version: ' . PHP_VERSION . "\n";
}

echo phpversion ( )." :phpversion()";
echo PHP_EOL;

echo __FILE__;
echo PHP_EOL;


/* Start Absolute path to the directory. */

/*

$phptxtrDir = '../gjtest/';

if(substr($phptxtrDir, -1) != DIRECTORY_SEPARATOR) $phptxtrDir .= DIRECTORY_SEPARATOR;



*/
gjpath();
echo PHP_EOL;

	$system_path = 'system';

if (realpath($system_path) !== FALSE) {
		$system_path = realpath($system_path) . '/';
	}

	// ensure there's a trailing slash
	$system_path = rtrim($system_path, '/') . '/';

	// Is the system path correct?
	if (!is_dir($system_path)) {
		echo ("Your system folder path does not appear to be set correctly. Please open the following file and correct this: " . pathinfo(__FILE__, PATHINFO_BASENAME));
	}

	/*
	 * -------------------------------------------------------------------
	 *  Now that we know the path, set the main path constants
	 * -------------------------------------------------------------------
	 */
	// The name of THIS file
	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

	// The PHP file extension
	// this global constant is deprecated.
	define('EXT', '.php');

	// Path to the system folder
	define('BASEPATH', str_replace("\\", "/", $system_path));

	// Path to the front controller (this file)
	define('FCPATH', str_replace(SELF, '', __FILE__));

	// Name of the "system folder"
	define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));


if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');


echo PHP_EOL;

echo 'abspath ';
echo ABSPATH;
echo PHP_EOL;

$message = "a short piece of text
spanning more than one line
and containing \"double\" & 'single' quotes";
echo $message;
echo PHP_EOL;

//conversion reminder
echo '<hr>';
var_dump(0 == "a"); // 0 == 0 -> true
var_dump("1" == "01"); // 1 == 1 -> true converts leading 0
var_dump("10" == "1e1"); // 10 == 10 -> true
var_dump(100 == "1e2"); // 100 == 100 -> true


// "||" has a greater precedence than "or"
$e = false || true; // $e will be assigned to (false || true) which is true
$f = false or true; // $f will be assigned to false
var_dump($e, $f);

// "&&" has a greater precedence than "and"
$g = true && false; // $g will be assigned to (true && false) which is false
$h = true and false; // $h will be assigned to true
var_dump($g, $h);
echo '<hr>';



$hh = (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST']: '');

echo 'hh : '.$hh;
//assets url http:///F:/bit5411/apps/gjsoap/htdocs/

echo PHP_EOL;
$assets_url =  (rtrim(str_replace('\\', '/', 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . rtrim($_SERVER['HTTP_HOST'], '\\/') . '/' . substr(rtrim(dirname(__FILE__), '\\/'), strlen($_SERVER['DOCUMENT_ROOT']))), '\\/') . '/');
echo 'assets url '.$assets_url;
echo PHP_EOL;

$data = array('foo'=>'bar',
              'baz'=>'boom',
              'cow'=>'milk',
              'php'=>'hypertext processor');

echo http_build_query($data) . "\n";
echo http_build_query($data, '', '&amp;');
echo PHP_EOL;


echo nl2br("Welcome\r\nThis is my HTML document", false);
//lets look at some pear
echo PHP_EOL;


//C:\php\pear\docs\XML_Util\examples\example.php

require_once 'XML/Util.php';

    /**
     * building document type declaration
     */
    print 'building DocType declaration:<br>';
    print htmlspecialchars(XML_Util::getDocTypeDeclaration('package',
        'http://pear.php.net/dtd/package-1.0'));
    print "\n<br><br>\n";


$modes = mcrypt_list_modes();


echo "mcrypt_list_modes <br>\n";

echo print_r_xml($modes);

//F:\bit5411\php\PEAR\OS\Guess.php  class OS_Guess
require_once 'OS/Guess.php';

$phpwhat = new OS_Guess();
//$phpwhat = OS_Guess::getSignature();  //fatal this
$tmp = $phpwhat->getSignature();
echo $tmp;
echo PHP_EOL;
$tmp = $phpwhat->getSysname();
echo $tmp;
echo PHP_EOL;
$tmp = $phpwhat->getNodename();
echo $tmp;
echo PHP_EOL;
$tmp = $phpwhat->getCpu();
echo $tmp;
echo PHP_EOL;
$tmp = $phpwhat->getRelease();
echo $tmp;
echo PHP_EOL;
$tmp = $phpwhat->getExtra();
echo $tmp;
echo PHP_EOL;

echo php_uname();
echo PHP_EOL;


foreach (glob("*.php") as $filename) {
    echo "$filename size " . filesize($filename) . "\n";
}
?>




