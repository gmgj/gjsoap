<?php
$xml = <<<XML
<!DOCTYPE foo PUBLIC "-//FOO/BAR" "http://example.com/foobar">
<foo>bar</foo>
XML;

xmlCatalogResolve() or xmlInitializeCatalog() or similar, maybe a little deeper...

My questions:

is there a way to debug PHPs use of libxml(2)?
what I forgot to use the catalo
 /etc/xml/catalog ..
simplexml_load_file

$dd = new DOMDocument;
$r = $dd->loadXML($xml);

var_dump(libxml_set_external_entity_loader([]));
var_dump(libxml_set_external_entity_loader());
var_dump(libxml_set_external_entity_loader(function() {}, 2));

var_dump(libxml_set_external_entity_loader(function($a, $b, $c, $d) {}));
var_dump($dd->validate());

echo "Done.\n";
