<?php
require_once('lib/nusoap.php');
$wsdl = "http://localhost/nusoap-0.9.5/webservice-server.php?wsdl";


$client = new nusoap_client($wsdl, 'wsdl');
$err = $client->getError();
if ($err) {
   echo '<h2>L\'erreur est :</h2>' . $err;
   exit();
}

$result = $client->call('GetCountriesIsoOfContinent', array("europe"));
echo "list of countries suggested in Europe is : ".$result;

?>