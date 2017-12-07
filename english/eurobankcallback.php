<?php

# Required File Includes
//include("../../../dbconnect.php");
require_once __DIR__ . '/../../../init.php';
include("../../../includes/functions.php");
include("../../../includes/gatewayfunctions.php");
include("../../../includes/invoicefunctions.php");

$gatewaymodule = "eurobanklib"; # Enter your gateway module name here replacing template

 $GATEWAY = getGatewayVariables($gatewaymodule);
 if (!$GATEWAY["type"]) die("Module Not Activated"); # Checks gateway module is active before accepting callback

# Get Returned Variables - Adjust for Post Variable Names from your Gateway's Documentation





$allok=1;
 

  

# connect to DB
	$host = $GATEWAY["gatewayDbRoot"]; //database location
	$user = $GATEWAY["gatewayDbUsername"]; //database location
	$pass = $GATEWAY["gatewayDbPassword"]; //database location
	$db_name = $GATEWAY["gatewayDbname"]; //database location
	
	
	$db_conn_eurobanklib = mysqli_connect($host, $user, $pass, $db_name);
	
	if (mysqli_connect_errno()) {
	  printf("Connect failed: %s\n", mysqli_connect_error());
	  exit();
  }


# queries 
$sql="SELECT * FROM eurobanklib_transactions where MerchantRef='".$_POST["Ref"]."' "; 

#perform the querries

$rs=mysqli_query($db_conn_eurobanklib,$sql) or die(" ".mysqli_error($db_conn_eurobanklib)); 
$rs_debug=mysqli_query( $db_conn_eurobanklib, $sql) or die(" ".mysqli_error($db_conn_eurobanklib)); 


if (!$rs)
{ 
exit("Error in SQL[NOTOK]");
} 

$rows_debug =mysqli_fetch_array($rs_debug);

while ($rows=mysqli_fetch_array($rs)){
$mid=$rows["MerchantID"];
$mr=  $rows["MerchantRef"];
$am=  $rows["Amount"];
$cr=  $rows["Currency"];

//echo "$mid";
//echo "$mr";
//echo "$am";
//echo "$cr";

}

//echo "$mid";
//echo "$mr";
//echo "$am";
//echo "$cr";

$am=$am/100;
//echo "$am";

$crncy=$_POST["Currency"];
$crncy= "0" . $crncy;
//echo "$crncy";

# close the connection
//mysql_close($db_conn_eurobanklib);
 


	 
	if (trim($_POST["Shop"])!=trim($mid)){
	echo "[WRONG MERCHANT ID IN VALIDATION]";
	echo $_POST["shop"];
	echo "$mid";
	$allok=0;
	
	$array_deb = array(
    "error" => "WRONG MERCHANT ID IN VALIDATION",
    "difference" => $_POST["shop"]." - ".$mid 
);

}  
	if (trim($_POST["Amount"])!=trim($am)){
	echo "[WRONG AMOUNT IN VALIDATION]";
	echo $_POST["Amount"];
	echo "$am";
	$allok=0;
	
	$array_deb = array(
    "error" => "WRONG AMOUNT IN VALIDATION",
    "difference" => $_POST["Amount"]." - ".$am 
);
}
	  
	if (trim($crncy)!=trim($cr)){
	echo "[WRONG CURRENCY IN VALIDATION]";
	echo "$crncy";
	echo "$cr";
	$allok=0;
	
	$array_deb = array(
    "error" => "WRONG CURRENCY IN VALIDATION",
    "difference" => $crncy." - ".$cr 
);
	
}
	  
	if (trim($_POST["Ref"])!=trim($mr)){
	echo "[WRONG MERCHANTREF IN VALIDATION]";
	echo $_POST["Ref"];
	echo "$mr";
	$allok=0;
	
		$array_deb = array(
    "error" => "WRONG MERCHANTREF IN VALIDATION",
    "difference" => $_POST["Ref"]." - ".$mr 
);
	
	
}
	 

////////////////////////

//$invoiceid = $_POST["Var1"];
$pieces = explode(" ", $_POST["Ref"]);
$invoiceid = trim($pieces[0]);
$Ref=$_POST["Ref"];
 
$invoiceid = checkCbInvoiceID($invoiceid,$GATEWAY["name"]); # Checks invoice ID is a valid invoice number or ends processing

checkCbTransID($Ref); # Checks transaction number isn't already in the database and ends processing if it does

 if ($allok==1){
	echo "[OK]<br>";
    # Successful
   
 } else {
 	echo "[NOTOK]<br>";
 	# Unsuccessful
     logTransaction($GATEWAY["name"],$_POST,"Unsuccessful"); # Save to Gateway Log: name, data array, status
	 logTransaction($GATEWAY["name"],$GATEWAY,"Unsuccessful"); # Save to Gateway Log: name, data array, status
	 logTransaction($GATEWAY["name"],$rows_debug,"Unsuccessful"); # Save to Gateway Log: name, data array, status
	 logTransaction($GATEWAY["name"],$array_deb,"Unsuccessful"); # Save to Gateway Log: name, data array, status
	 
	 
 }

?>