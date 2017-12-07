<?php

require_once __DIR__ . '/../../../init.php';
 
$whmcs->load_function('gateway');
$whmcs->load_function('invoice');


$gatewaymodule = "eurobanklib"; # Enter your gateway module name here replacing template
$GATEWAY = getGatewayVariables($gatewaymodule);
if (!$GATEWAY['type']) {
    die("Module Not Activated");
}

$mid = $_POST['mid'];
$orderid = $_POST['orderid'];
$orderAmount = $_POST['orderAmount'];
$status = $_POST['status'];
$post_digest = $_POST['digest'];
$paymentRef = isset($_POST['paymentRef'])?$_POST['paymentRef']:'';
$txId = $_POST['txId'];
$riskScore = isset($_POST['riskScore'])?$_POST['riskScore']:'';
$message = isset($_POST['message'])?$_POST['message']:'';
$payMethod = isset($_POST['payMethod'])?$_POST['payMethod']:'';
$invoiceId = $orderid;
$form_data = '';
foreach ($_POST as $k => $v) {
    if (!in_array($k,array('_charset_','digest','submitButton'))){
        $form_data .= $_POST[$k];
    }
}
$form_data .= $GATEWAY['gatewaymerchantpassword'];
$paymentSuccess = false;
$digest = calculate_digest($form_data);
if ($digest != $post_digest) {
    logTransaction($GATEWAY["name"],$_POST,"Unsuccessful Confirmation. Invalid Digest."); # Save to Gateway Log: name, data array, status
}
else{
    //AUTHORIZED, CAPTURED,CANCELED,REFUSED,ERROR
    if (isset($_GET['result']) && ($_GET['result'] == 'success')) {
        
        if ($status == 'CAPTURED') {                                   
            $Ref=$txId;
            $Amount=$orderAmount;            
            $invoiceId = checkCbInvoiceID($invoiceId,$GATEWAY["name"]); # Checks invoice ID is a valid invoice number or ends processing            
            checkCbTransID($Ref); # Checks transaction number isn't already in the database and ends processing if it does            
            logTransaction($GATEWAY["name"],$_POST,"Successful"); # Save to Gateway Log: name, data array, status
            addInvoicePayment($invoiceId,$Ref,$Amount,0,$gatewaymodule); # Apply Payment to Invoice: invoiceid, transactionid, amount paid, fees, modulename
            $paymentSuccess = true;
        }
        else if ($status == 'ERROR') {
            logTransaction($GATEWAY["name"],$_POST,"Unsuccessful Confirmation. Unknown error."); # Save to Gateway Log: name, data array, status
        }
        else if ($status == 'CANCELED') {
            logTransaction($GATEWAY["name"],$_POST,"Unsuccessful Confirmation. CANCELED"); # Save to Gateway Log: name, data array, status
        } 
        else {//Failed Response codes
            logTransaction($GATEWAY["name"],$_POST,"Unsuccessful Confirmatio. $status"); # Save to Gateway Log: name, data array, status
        }
    }
    else if (isset($_GET['result']) && ($_GET['result'] == 'failure')) {
        logTransaction($GATEWAY["name"],$_POST,"Unsuccessful Confirmation"); # Save to Gateway Log: name, data array, status
    }
}
callback3DSecureRedirect($invoiceId, $paymentSuccess);
