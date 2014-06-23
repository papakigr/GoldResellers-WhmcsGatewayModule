<?PHP 


include("dbconnect.php");
include("includes/functions.php");
include("includes/gatewayfunctions.php");
include("includes/invoicefunctions.php");


 $gatewaymodule = "eurobanklib"; # Enter your gateway module name here replacing template

 $GATEWAY = getGatewayVariables($gatewaymodule);
 
 

# connect to DB
	$host = $GATEWAY["gatewayDbRoot"]; //database location
	$user = $GATEWAY["gatewayDbUsername"]; //database location
	$pass = $GATEWAY["gatewayDbPassword"]; //database location
	$db_name = $GATEWAY["gatewayDbname"]; //database location
	
	
	if($db_conn_eurobanklib = mysql_connect($host,$user ,$pass))
		{
			mysql_select_db($db_name) or die(mysql_error());
		}
	else
	  {
		die('Could not connect: ' . mysql_error());
	 }



 

 
$query="CREATE TABLE `eurobanklib_confirmation` (
  `password` varchar(45) NOT NULL default '',
  `amount` varchar(45) NOT NULL default '',
  `currency` varchar(45) NOT NULL default '',
  `currencysymbol` varchar(45) NOT NULL default '',
  `ref` varchar(45) NOT NULL default '',
  `transid` varchar(45) NOT NULL default '',
  `var1` varchar(45) NOT NULL default '',
  `var2` varchar(45) NOT NULL default '',
  `var3` varchar(45) NOT NULL default '',
  `var4` varchar(45) NOT NULL default '',
  `var5` varchar(45) NOT NULL default '',
  `var6` varchar(45) NOT NULL default '',
  `var7` varchar(45) NOT NULL default '',
  `var8` varchar(45) NOT NULL default '',
  `var9` varchar(45) NOT NULL default '',
  `method` varchar(45) NOT NULL default '',
  `id` int(11) NOT NULL auto_increment,
  `shop` varchar(45) NOT NULL default '',
  PRIMARY KEY  (`id`)
)";

$result=mysql_query($query,$db_conn_eurobanklib);
  
$query="CREATE TABLE `eurobanklib_transactions` (
  `MerchantRef` varchar(45) NOT NULL default '',
  `Amount` double NOT NULL default '0',
  `Currency` varchar(45) NOT NULL default '',
  `MerchantID` varchar(45) NOT NULL default '',
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  USING BTREE (`id`)
)";

$result=mysql_query($query,$db_conn_eurobanklib);





 
	
if(mysql_error()){
 
 
 echo "Δημιουργήθηκε κάποιο σφάλμα κατά τη δημιουργία των πινάκων. Προσπαθήστε ξανά.";
 echo "<p>MySQL Error #" . mysql_errno() . "</b></p><p>" . mysql_error() . "</p>"; 
		die("");
}
else{
echo "Πραγματοποιήθηκε επιτυχώς η δημιουργία των πινάκων ";
?>
  

<?PHP 
}


?>