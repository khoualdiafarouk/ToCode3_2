<?php

ini_set("soap.wsdl_cache_enabled", "0");

// include App code
include('ConvertEURtoTND.php');
 
// give contract location 
$serveurSOAP = new SoapServer('http://localhost/mywebservices/ConvertEURtoTND.wsdl');
 
// Add endpoints to the web services (getHello)
$serveurSOAP->addFunction('ConvertEURtoTND');
 
//run the server
//  POST method is only authorized 
if ($_SERVER['REQUEST_METHOD'] == 'POST')
 {
// handling call
        $serveurSOAP->handle();
}
// print link to WSDL
else {
	echo 'ConvertEURtoTND.<br />';
	echo '<a href="http://localhost/mywebservices/ConvertEURtoTND.wsdl">WSDL</a><br />';    
}  
?>