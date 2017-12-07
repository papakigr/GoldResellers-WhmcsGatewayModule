<?PHP

 # Required File Includes
//include("dbconnect.php");
require_once __DIR__ . '/init.php';
include("includes/functions.php");
include("includes/gatewayfunctions.php");
include("includes/invoicefunctions.php");
?>

<html>
    <head>
        <title></title>
    </head>
    <body>

       
	<?php 

 


$gatewaymodule = "eurobanklib"; # Enter your gateway module name here replacing template

 $GATEWAY = getGatewayVariables($gatewaymodule);
 
 

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
 


# query 
$query = "INSERT INTO eurobanklib_confirmation(shop,password,amount,currency,currencysymbol,ref,transid,var1,var2,var3,var4,var5,var6,var7,var8,var9,method) VALUES ('$_POST[Shop]','$_POST[Password]','$_POST[Amount]','$_POST[Currency]','$_POST[Currencysymbol]','$_POST[Ref]','$_POST[Transid]','$_POST[Var1]','$_POST[Var2]','$_POST[Var3]','$_POST[Var4]','$_POST[Var5]','$_POST[Var6]','$_POST[Var7]','$_POST[Var8]','$_POST[Var9]','$_POST[Method]');";
//echo $query;
# perform the query
$result = mysqli_query(  $db_conn_eurobanklib,$query) or die("[NOTOK] error insert mysql"); 



#Esto to proepilegmeno password poy exoume sta options tou merchant = "mypassword"

$pieces = explode(" ", $_POST["Ref"]);
$invoiceid = trim($pieces[0]);
$Ref=$_POST["Ref"];
$Amount=$_POST['Amount'];
 
$invoiceid = checkCbInvoiceID($invoiceid,$GATEWAY["name"]); # Checks invoice ID is a valid invoice number or ends processing

checkCbTransID($Ref); # Checks transaction number isn't already in the database and ends processing if it does



if ($_POST["Password"]==$GATEWAY["gatewaymerchantpassword"]){ //put your password here
	echo "[OK]";
	 # Successful
	 $_POST['Password']="*******";
    addInvoicePayment($invoiceid,$Ref,$Amount,0,$gatewaymodule); # Apply Payment to Invoice: invoiceid, transactionid, amount paid, fees, modulename
	logTransaction($GATEWAY["name"],$_POST,"Successful"); # Save to Gateway Log: name, data array, status
	
	
	}
else{
	echo "[NOTOK]";
	  logTransaction($GATEWAY["name"],$_POST,"Unsuccessful Confirmation"); # Save to Gateway Log: name, data array, status
	
}

?>

</body>
</html>
