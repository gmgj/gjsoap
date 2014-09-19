<?php
/**
 * @link http://stackoverflow.com/questions/13865149/speeding-up-xml-schema-validations-of-a-batch-of-xml-files-against-the-same-xml
 */

$mapping = [
    'http://www.w3.org/2002/08/xhtml/xhtml1-transitional.xsd' => 'schema/xhtml1-transitional.xsd',
    'http://www.w3.org/2001/xml.xsd'                          => 'schema/xml.xsd',
];

libxml_set_external_entity_loader(
    function ($public, $system, $context) use ($mapping) {

        if (is_file($system)) {
            return $system;
        }

        if (isset($mapping[$system])) {
            return __DIR__ . '/' . $mapping[$system];
        }

        $message = sprintf(
            "Failed to load external entity: Public: %s; System: %s; Context: %s",
            var_export($public, 1), var_export($system, 1),
            strtr(var_export($context, 1), [" (\n  " => '(', "\n " => '', "\n" => ''])
        );

        throw new RuntimeException($message);
    }
);

$data_dom = new DOMDocument();
$data_dom->load('test-data.xml');
$data_dom->xinclude();

// Multiple validations using the schemaValidate method.
for ($attempt = 1; $attempt <= 3; $attempt++) {
    $start = time();
    echo "schemaValidate: Attempt #$attempt returns ";
    if (!$data_dom->schemaValidate('test-schema.xsd')) {
        echo "Invalid!";
    } else {
        echo "Valid!";
    }
    $end = time();
    echo " in " . ($end - $start) . " seconds.\n";
}

// Loading schema into a string.
$schema_source = file_get_contents('test-schema.xsd');

// Multiple validations using the schemaValidate method.
for ($attempt = 1; $attempt <= 3; $attempt++) {
    $start = time();
    echo "schemaValidateSource: Attempt #$attempt returns ";
    if (!$data_dom->schemaValidateSource($schema_source)) {
        echo "Invalid!";
    } else {
        echo "Valid!";
    }
    $end = time();
    echo " in " . ($end - $start) . " seconds.\n";
}