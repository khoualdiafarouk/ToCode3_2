<?php
//include the class that will generate WSDL file from PhP class
require "php2wsdl/src/PHPClass2WSDL.php";
require "vendor/autoload.php"; 
// will be created by composer once you install php composer and run composer install
//don't forget to create composer.json file

$class="Convert";
$serviceURI="http://localhost/mywebservices/WSTD.php";
$expectedFile="ConvertEURtoTND.wsdl";

// include the class we want to use
require "ConvertEURtoTND.php";

$gen = new \PHP2WSDL\PHPClass2WSDL($class, $serviceURI);

// Generate the WSDL from the class adding only the public methods.
$gen->generateWSDL();

//store generated wsdl content in a file
file_put_contents($expectedFile, $gen->dump());

//show a link to generated WSDL
echo "Generated WSDL:";
echo "<a href='http://localhost/mywebservices/$expectedFile'>$expectedFile</a><br/>";
?>