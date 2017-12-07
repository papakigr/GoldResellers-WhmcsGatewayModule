<?php
 
# Set the Gateway Variables
$GATEWAYMODULE = array(
    "eurobanklibname" => "eurobanklib",
    "eurobanklibvisiblename" => "Eurobank",
    "eurobanklibtype" => "CC", # Invoices or CC
);

function eurobanklib_activate() {
    # Here you need to define the fields required to configure your gateway - vars: template, type, name, default value, friendly name, size, description
    
	defineGatewayField("eurobanklib","text","gatewaymerchantid","","MerchantId","20","");
	defineGatewayField("eurobanklib","text","gatewaymerchantpassword","","Merchant Password","20","");
	defineGatewayField("eurobanklib","text","gatewayyouremail","","Email","50","");
	defineGatewayField("eurobanklib","text","gatewayBankurl","","Bank Post Url","50","For example https://ep.eurocommerce.gr/proxypay/apacs");
	defineGatewayField("eurobanklib","text","gatewaycurrency","","Currency","20","0978 for EUR");
	defineGatewayField("eurobanklib","text","gatewaylang","","Language","20","Type GR");
	defineGatewayField("eurobanklib","text","gatewayDbname","","DBName","20","");
	defineGatewayField("eurobanklib","text","gatewayDbRoot","","DBRoot","20","");
	defineGatewayField("eurobanklib","text","gatewayDbUsername","","DBUsername","20","");
	defineGatewayField("eurobanklib","text","gatewayDbPassword","","DBPasswprd","20","");
	
	 
}

function eurobanklib_link($params) {

	# Gateway Specific Variables
	//$gatewayusername = $params['username'];
	//$gatewaytestmode = $params['testmode'];
	$url=$params['gatewayBankurl'];
	 
	# Invoice Variables
	$invoiceid = $params['invoiceid'];
	$description = $params["description"];
    $amount = $params['amount']; # Format: ##.##
    $currency = $params['gatewaycurrency']; # Currency Code
	 $language = $params['gatewaylang']; # Currency Code

	# Client Variables
	$firstname = $params['clientdetails']['firstname'];
	$lastname = $params['clientdetails']['lastname'];
	$email = $params['clientdetails']['email'];
	$address1 = $params['clientdetails']['address1'];
	$address2 = $params['clientdetails']['address2'];
	$city = $params['clientdetails']['city'];
	$state = $params['clientdetails']['state'];
	$postcode = $params['clientdetails']['postcode'];
	$country = $params['clientdetails']['country'];
	$phone = $params['clientdetails']['phonenumber'];

	# System Variables
	$companyname = $params['companyname'];
	$systemurl = $params['systemurl'];
	 

	# Enter your code submit to the gateway...
	$gatewaymerchantid = $params['gatewaymerchantid'];
	$gatewayemail = $params['gatewayyouremail'];
	$price=$amount*100;
	$reference=$invoiceid." ".date("his");
	
	
	

	$code = '<form  name="PayformVisa" Method="POST" action="'.$url.'">
  <input type="hidden" Name="APACScommand" value="NewPayment">
        <INPUT TYPE="hidden" Name="merchantID" VALUE="'.$gatewaymerchantid.'">
        <INPUT TYPE="hidden" Name="amount" VALUE="'.$price.'">
        <INPUT TYPE="hidden" Name="merchantRef" VALUE="'.$reference.'" >
        <INPUT TYPE="hidden" Name="merchantDesc" VALUE="online payment">
        <INPUT TYPE="hidden" Name="currency" VALUE="'.$currency.'">  
        <INPUT TYPE="hidden" Name="lang" VALUE="'.$language.'">
        <INPUT TYPE="hidden" Name="Var1" VALUE="'.$invoiceid.'">
        <INPUT TYPE="hidden" Name="Var2" VALUE="">
        <INPUT TYPE="hidden" Name="Var3" VALUE="">
        <INPUT TYPE="hidden" Name="Var4" VALUE="">
        <INPUT TYPE="hidden" NAME="Var5" VALUE="">
        <INPUT TYPE="hidden" NAME="Var6" VALUE="">
        <INPUT TYPE="hidden" Name="Var7" VALUE="">
        <INPUT TYPE="hidden" Name="Var8" VALUE="">
        <INPUT TYPE="hidden" Name="Var9" VALUE="">
        <INPUT TYPE="hidden" Name="CustomerEmail" VALUE="'.$gatewayemail.'">
		 <INPUT TYPE="hidden" Name="bankurl" VALUE="'.$bankurl.'">
		<input type="submit" value="Pay">
</form>';

		
	$host = $params["gatewayDbRoot"]; //database location
	$user = $params["gatewayDbUsername"]; //database location
	$pass = $params["gatewayDbPassword"]; //database location
	$db_name = $params["gatewayDbname"]; //database location
	
	
	$db_conn_eurobanklib = mysqli_connect($host, $user, $pass, $db_name);
	
	if (mysqli_connect_errno()) {
	  printf("Connect failed: %s\n", mysqli_connect_error());
	  exit();
  }
		
		
		$query = "INSERT INTO eurobanklib_transactions( MerchantRef , Amount , Currency , MerchantID) VALUES ('".$reference."','".$price."','".$currency."','".$gatewaymerchantid."')";
		//echo $query;
		# perform the query
		$result=mysqli_query($db_conn_eurobanklib,$query);
		
		 
		 
	
	
	return $code;
}



 

?>
