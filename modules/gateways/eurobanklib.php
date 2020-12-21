<?php
/*
Eurobank WhmcsGatewayModule
===========================
Gateway Module for payments via Eurobank
Version: 4.0
*/
# Set the Gateway Variables
$GATEWAYMODULE = array(
    "eurobanklibname" => "eurobanklib",
    "eurobanklibvisiblename" => "Eurobank",
    "eurobanklibtype" => "CC", # Invoices or CC
);

function eurobanklib_activate()
{
    # Here you need to define the fields required to configure your gateway - vars: template, type, name, default value, friendly name, size, description

    defineGatewayField("eurobanklib", "text", "gatewaymerchantid", "", "MerchantId", "20", "");
    defineGatewayField("eurobanklib", "text", "gatewaymerchantpassword", "", "Shared Secret", "20", "");
    defineGatewayField("eurobanklib", "text", "gatewaycurrency", "", "Currency", "20",
        "ISO 4217 alphabetic code (EUR, USD)");
    defineGatewayField("eurobanklib", "text", "gatewaylang", "", "Language", "20", "Type GR");
    defineGatewayField("eurobanklib", "yesno", "testmode", "", "Test Mode", "",
        "Enable testing mode. CAUTION: DO NOT USE IN PRODUCTION!");
}

function eurobanklib_link($params)
{

    # Gateway Specific Variables
    //$gatewayusername = $params['username'];
    //$gatewaytestmode = $params['testmode'];
    //$url"https://vpos.eurocommerce.gr/vpos/shophandlermpi";

    # Invoice Variables
    $invoiceid = $params['invoiceid'];
    $description = $params["description"];
    $amount = $params['amount']; # Format: ##.##
    $currency = $params['gatewaycurrency']; # Currency Code
    $language = $params['gatewaylang']; # Currency Code
    $testmode = $params['testmode'];

    $url = 'https://vpos.eurocommerce.gr/vpos/shophandlermpi';
    if ($testmode== "on") {
        $url = 'https://euro.test.modirum.com/vpos/shophandlermpi';
    }

    // Client Parameters
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
    // System Parameters
    $companyName = $params['companyname'];
    $systemUrl = $params['systemurl'];
    $returnUrl = $params['returnurl'];
    $langPayNow = $params['langpaynow'];
    $moduleDisplayName = $params['name'];
    $moduleName = $params['paymentmethod'];
    $whmcsVersion = $params['whmcsVersion'];



    $gatewaymerchantid = $params['gatewaymerchantid'];
    $price = $amount;

    $form_data_array = array(
        'version' => 2,
        'mid' => $gatewaymerchantid,
        'lang' => $language,
        'deviceCategory' => '0',
        'orderid' => $invoiceid  .'Inv'. date('Ymdhis'),
        'orderDesc' => 'Order #' . $invoiceid,
        'orderAmount' => $price,
        'currency' => $currency,
        'payerEmail' => $email,
        'billCountry' => $country,
        'billState' => $state,
        'billZip' => $postcode,
        'billCity' => $city,
        'billAddress' => $address1,
        'confirmUrl' => $systemUrl . "modules/gateways/callback/eurobankreturn.php?result=success",
        'cancelUrl' => $systemUrl . "modules/gateways/callback/eurobankreturn.php?result=failure"

    );

    $form_secret = $params['gatewaymerchantpassword'];
    $form_data = iconv('utf-8', 'utf-8//IGNORE', implode("", $form_data_array)). $form_secret;

    $digest = calculate_digest($form_data);

    $html = '<form name="PayformVisa" action="' . $url . '" method="post" id="eb_payment_form" target="_top" accept-charset="UTF-8">';
    foreach ($form_data_array as $key => $value) {
        $html .= '<input type="hidden" id="' . $key . '" name="' . $key . '" value="' . iconv('utf-8', 'utf-8//IGNORE', $value) . '"/>';
    }
    $html .= '<input type="hidden" id="digest" name="digest" value="' . $digest . '"/>';
    $html .= '<input type="submit" value="Pay"></form>';
    $code = $html;

    return $code;
}

function calculate_digest($input)
{

    $digest = base64_encode(hash('sha256', ($input), true));

    return $digest;
}
