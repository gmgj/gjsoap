<?php
require_once 'includes/gj_utility.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Soap Tests</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div id="wrapper">
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-11">
				<h1>Check back in for daily updates</h1>
			</div>
		</div><!-- /.row -->

		<div id="accordion" class="col-lg-11">
			<h3>Hello <small>Soap,</small> world!</h3>
			<div style='margin:0; padding:10px 0 10px 10px;'>
				<a class="AFour"  target="_blank" href="http://garyjohnsoninfo.info/gjsoap/hwsoapserver.php">check if server can start</a><br>
				<a class="AFour"  target="_blank" href="hwsoapclient.php">run local client</a><br>
				<a class="AFour"  target="_blank" href="showsrc.php">show source</a><br>
			</div>

			<h3>Hello <small>wsdl,</small> world! gj only</h3>
			<div style='margin:0; padding:10px 0 10px 10px;'>
				<a class="AFour"  target="_blank" href="http://garyjohnsoninfo.info/gjsoap/simplewsdl/simpleserver.php">check if server can run</a><br>
				<a class="AFour"  target="_blank" href="simplewsdl/simpleclient.php">run local client</a><br>
			</div>


			<h3>SOAP Docs</h3>
			<div style='margin:0; padding:10px 0 10px 10px;'>
				<a class="AFour" target="_blank" href="http://www.whitewashing.de/2014/01/31/soap_and_php_in_2014.html">Soap in 2014</a><br>
				<a class="AFour" target="_blank" href="http://www.w3.org/TR/soap/">w3 specs</a><br>
				<a class="AFour" target="_blank" href="http://www.w3.org/TR/2007/REC-soap12-part1-20070427/">w3 messaging</a><br>
				<a class="AFour" target="_blank" href="http://wso2.com/products/web-services-framework/php/">ws02 framework</a><br>
				<a class="AFour" target="_blank" href="https://github.com/wso2/wsf">wso2 on github</a><br>
				<a class="AFour" target="_blank" href="http://php.net/manual/en/book.soap.php/">PHP SOAP</a><br>
				<a class="AFour" target="_blank" href="http://php.net/manual/en/class.soapclient.php">SOAP Client</a><br>
				<a class="AFour" target="_blank" href="http://php.net/manual/en/class.soapserver.php">SOAP Server</a><br>
				<a class="AFour" target="_blank" href="http://us1.php.net/manual/en/refs.xml.php">PHP XML Manipulation</a><br>
			</div>
			<h3>Pear </h3>
			<pre>
			From Jan Schneider (yunosh@php.net) Listed as lead for PEAR SOAP
			Hello Gary,
			[This message has been brought to you via pear.php.net.]
			I no longer maintain the package, and in fact it's completely unmaintained for years now.

			SOAP_FAULT lools to be recursive -> try over riding with use_soap_error_handler
			</pre>
			<div style='margin:0; padding:10px 0 10px 10px;'>
				<a class="AFour" target="_blank" href="http://pear.php.net/package/SOAP_Interop/">Pear SOAP_Interop</a><br>
				<a class="AFour" target="_blank" href="http://pear.php.net/package/SOAP">Pear SOAP <span style="font-family:monospace">-&gt;</span>see browse the source tree or install or download</a><br>
				<a class="AFour" target="_blank" href="stockquote.php">NG stockquote</a><br>
				<a class="AFour" target="_blank" href="attachment.php">NG local attachment</a><br>
			</div>

			<h3>WSDL</h3>
			<div style='margin:0; padding:10px 0 10px 10px;'>
				<a class="AFour" target="_blank" href="http://www.w3.org/TR/wsdl">w3 wsdl</a><br>
				<a class="AFour" target="_blank" href="http://wsdlbrowser.com/">http://wsdlbrowser.com/</a><br>
				<a class="AFour" target="_blank" href="http://www.soapclient.com/">http://www.soapclient.com</a><br>
				<a class="AFour" target="_blank" href="http://xml.coverpages.org/soap.html">xml coverpages soap</a><br>
				<a class="AFour" target="_blank" href="http://soapagent.com/">soapagent</a><br>
				<a class="AFour" target="_blank" href="http://xmethods.net/ve2/index.po">xmethods - test services</a><br>
				<a class="AFour" target="_blank" href="http://www.informit.com/articles/article.aspx?p=99974&seqNum=3">soap wsdl book</a><br>
				<a class="AFour" target="_blank" href="http://www.herongyang.com/WSDL/WSDL-11-Introduction-WSDL-11-Framework-and-Extension.html">herongyang.co</a><br>
			</div>


			<h3>Misc</h3>
			<div style='margin:0; padding:10px 0 10px 10px;'>
				<a class="AFour" target="_blank" href="https://bugs.php.net/">https://bugs.php.net soap is not clean</a><br>
				<a class="AFour" target="_blank" href="http://www.whitemesa.com/interop.htm">soapbuilders interoperabiltiy lab</a><br>
				<a class="AFour" target="_blank" href="http://qa.php.net/write-test.php">php qa write phpt test suite bugs</a><br>
				<a class="AFour" target="_blank" href="http://phpunit.de/">phpunit</a><br>
				<a class="AFour" target="_blank" href="https://github.com/mattclements/NuSOAP">a nuSOAP 2 years old</a><br>
				<a class="AFour" target="_blank" href="http://www.soapui.org/">http://www.soapui.org/</a><br>
				<a class="AFour" target="_blank" href="https://github.com/lcobucci/easy-soap">easy soap next</a><br>
				<a class="AFour" target="_blank" href="http://www.packtpub.com/article/soap-and-php-5">soap and php 5</a><br>
				<a class="AFour" target="_blank" href="http://devzone.zend.com/25/php-soap-extension/">zend soap extension</a><br>
				<a class="AFour" target="_blank" href="https://github.com/BeSimple/BeSimpleSoap">BeSimpleSoapBundle Symfony2 to build WSDL and SOAP based</a><br>
				<a class="AFour" target="_blank" href="https://github.com/TheFrozenFire/PHP-Mindbody-API-Library">Mindful</a><br>
				<a class="AFour" target="_blank" href="https://github.com/modernfidelity/Simple-PHP-Soap-Service">simple servcie</a><br>
				<a class="AFour" target="_blank" href="https://github.com/LeaseWeb/php-soap-client">A cmd line to explore SOAP services</a><br>
				<a class="AFour" target="_blank" href="http://bisqwit.iki.fi/story/howto/phpajaxsoap/">A nice tutorial on simple service</a><br>
				<a class="AFour" target="_blank" href="http://www.ibm.com/developerworks/library/ws-whichwsdl/">IBM on wsdl styles</a><br>
				<a class="AFour" target="_blank" href="http://axis.apache.org/axis/cpp/index.html">apache axis SOAP in c++</a><br>
				<a class="AFour" target="_blank" href="http://www.slimframework.com/">slimframework</a><br>
				<a class="AFour" target="_blank" href="http://www.crosschecknet.com/products/soapsonar.php">crosschecknet</a><br>
				<a class="AFour" target="_blank" href="http://www.phpclasses.org/package/251-PHP-SOAP-protocol-requests-handler-.html">phpclasses protocol requests</a><br>
				<a class="AFour" target="_blank" href="http://www.phpclasses.org/package/3640-PHP-Add-WSSecurity-authentication-to-PHP-5-SOAP-client.html">phpclasses WSSecurity</a><br>
				<a class="AFour" target="_blank" href="http://www.phpclasses.org/package/6546-PHP-Generate-class-code-for-calling-a-SOAP-Web-service.html">phpclasses gen class code</a><br>
			</div>
<!--


		<a class="btn btn-link" href="soapnotes.php.txt">a few Soap Notes</a>
-->

<pre>
		<?php highlight_file('soapnotes.php'); ?>
</pre>

		</div>


	</div><!-- /#page-wrapper -->

</div><!-- /#wrapper -->

<script src="js/jquery-1.11.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="../XXSoftwareTools/js/gjtrack.js"></script>
</body>
</html>