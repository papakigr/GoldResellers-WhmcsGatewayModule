<?php

define("CLIENTAREA",true);
//define("FORCESSL",true); # Uncomment to force the page to use https://

//require("dbconnect.php");
require_once __DIR__ . '/init.php';
require("includes/functions.php");
//require("includes/clientareafunctions.php");

$pagetitle = $_LANG['clientareatitle'];
$breadcrumbnav = '<a href="index.php">'.$_LANG['globalsystemname'].'</a>';
$breadcrumbnav .= ' > <a href="paymentnotcompleted.php">Payment not Completed</a>'; 

initialiseClientArea($pagetitle,'',$breadcrumbnav);

# To assign variables to the template system use the following syntax.
# These can then be referenced using {$variablename} in the template.

$smartyvalues["variablename"] = $value; 

# Check login status
if ($_SESSION['uid']) {

  # User is logged in - put any code you like here

  # Here's an example to get the currently logged in clients first name

 // $result = mysql_query("SELECT firstname FROM tblclients WHERE id=".(int)$_SESSION['uid']);
//  $data = mysql_fetch_array($result);
//  $clientname = $data[0];
//  $smartyvalues["clientname"] = $clientname;


} else {

  # User is not logged in

}
 
# Define the template filename to be used without the .tpl extension

$templatefile = "paymentnotcompleted"; 

outputClientArea($templatefile);

?>
