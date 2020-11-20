<?php
  
	require_once('lib/nusoap.php');
	$error  = '';
	$result = '';
	$wsdl1 = "http://localhost/nusoap-0.9.5/webservice-server.php?wsdl";
	$wsdl2 ="http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL";
	if(isset($_POST['search'])){
		$Continent = trim($_POST['Continent']);
		if(!$Continent){
			$error = 'Continent name cannot be left blank.';
		}

		if(!$error){
			//create client object
			    $client = new nusoap_client($wsdl1, true);
				$result = $client->call('GetRandomCountriyIsoOfContinent', array($Continent));
				$result = json_decode($result);
				$client1 = new nusoap_client($wsdl2, true);
				$response =  $client1->call('FullCountryInfo', array('sCountryISOCode'=>$result));
				
			}
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>country suggestion for travelling Web Service</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>country suggestion for travelling SOAP Web Service</h2>
  <p>Enter <strong>a continent name</strong> and we will look for a <strong>suggested country</strong> for you.</p>
  <br />       
  <div class='row'>
  	<form class="form-inline" method = 'post' name='form1'>
  		<?php if($error) { ?> 
	    	<div class="alert alert-danger fade in">
    			<a href="#" class="close" data-dismiss="alert">&times;</a>
    			<strong>Error!</strong>&nbsp;<?php echo $error; ?> 
	        </div>
		<?php } ?>
	    <div class="form-group">
	      <label for="Continent">Continent:</label>
	      <input type="text" class="form-control" name="Continent" id="Continent" placeholder="Enter Continent name" required>
	    </div>
	    <button type="submit" name='search' class="btn btn-default">Search for Country Desintination</button>

    </form>
   </div>
<br />
<p>--------------------------------- Country Full details ---------------------------------</p>
    <table>
        <tr>
            <td><strong>Country Code :</strong></td>
            <td><?php echo $response['FullCountryInfoResult']['sISOCode'];?></td>
        </tr>
        <tr>
            <td><strong>Country Name :</strong></td>
            <td><?php echo $response['FullCountryInfoResult']['sName'];?></td>
        </tr>
        <tr>
            <td><strong>Country Capital City :</strong></td>
            <td><?php echo $response['FullCountryInfoResult']['sCapitalCity'];?></td>
        </tr>
        <tr>
            <td><strong>Country Phone Code :</strong></td>
            <td><?php echo $response['FullCountryInfoResult']['sPhoneCode'];?></td>
        </tr>
        <tr>
            <td><strong>Country Currency :</strong></td>
            <td><?php echo $response['FullCountryInfoResult']['sCurrencyISOCode'];?></td>
        </tr>
        <tr>
            <td><strong>Country Language Code : </strong></td>
            <td><?php echo $response['FullCountryInfoResult']['Languages']['tLanguage']['sISOCode'];?></td>
        </tr> 
        <tr>
            <td><strong>Country Language Name :</strong></td>
            <td><?php echo $response['FullCountryInfoResult']['Languages']['tLanguage']['sName'];?></td>
        </tr>
        <tr>
            <td><strong>Country Flag :</strong></td>
            <td><img src="<?=($response['FullCountryInfoResult']['sCountryFlag'])?>" ></td>
        </tr>                                         
    </table>
    	
</body>
</html>