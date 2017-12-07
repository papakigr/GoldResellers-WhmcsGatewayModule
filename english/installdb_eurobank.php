<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
//include("dbconnect.php");
require_once __DIR__ . '/init.php';
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
  
  $db_conn_eurobanklib = mysqli_connect($host, $user, $pass, $db_name);
  
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
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
 
if (mysqli_query($db_conn_eurobanklib,$query) === TRUE) {
  printf("Table eurobanklib_confirmation successfully created.<br>");
}
else{
  echo "An error occured. Try again [1]";
  echo "<p>MySQL Error #" . mysqli_errno($db_conn_eurobanklib) . "</b></p><p>" . mysqli_error($db_conn_eurobanklib) . "</p>"; 
  die("");
}
$query="CREATE TABLE `eurobanklib_transactions` (
  `MerchantRef` varchar(45) NOT NULL default '',
  `Amount` double NOT NULL default '0',
  `Currency` varchar(45) NOT NULL default '',
  `MerchantID` varchar(45) NOT NULL default '',
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  USING BTREE (`id`)
)";
 
if (mysqli_query($db_conn_eurobanklib,$query) === TRUE) {
  printf("Table eurobanklib_transactions successfully created.<br>");
}
else{
  echo "An error occured. Try again [2]";
  echo "<p>MySQL Error #" . mysqli_errno($db_conn_eurobanklib) . "</b></p><p>" . mysqli_error($db_conn_eurobanklib) . "</p>"; 
  die("");
}

  echo "Completed Successfully";



?>