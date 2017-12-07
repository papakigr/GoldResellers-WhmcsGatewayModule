WhmcsGatewayModule
==================

Gateway Module for payments via Eurobank
Version: 2.0
Compatible with WHMCS v6.0 and newer.

1) You have to have accounts in Eurobank. 
Eurobank requests 5 urls. The 5 urls are the following 

Post url:                         https://www.mysite.gr/whmcs/viewinvoice.php
PaymentCompleted:                 https://www.mysite.gr/whmcs/paymentcompleted.php
PaymentNotCompleted:                 https://www.mysite.gr/whmcs/paymentnotcompleted.php
Confirmation:                         https://www.mysite.gr/whmcs/confirmccdpay.php
ValidateUrl:                         https://www.mysite.gr/whmcs/modules/gateways/callback/eurobankcallback.php

where https://www.mysite.gr/whmcs is your whmcs forder destination


2)Upload the file  eurobanklib.php in the folder whmcs/modules/gateways 


3) Login to whmcs admin panel kai select : Setup -> Payment Gateways
activate  ΕurobankLib module
Then fill all the required fields with information which is provided by Eurobank
All fields are required

Create a database and continue to the step4
 

4) Table Creation
 

Upload the file https://www.mysite.gr/whmcs το αρχείο installdb_eurobank.php
and open the url   https://www.mysite.gr/whmcs/installdb_eurobank.php
When the installiation completes successfully delete the file from your server.

5) Upload the following files to  your server:
https://www.mysite.gr/whmcs/paymentcompleted.php
https://www.mysite.gr/whmcs/paymentnotcompleted.php
https://www.mysite.gr/whmcs/confirmccdpay.php
https://www.mysite.gr/whmcs/modules/gateways/callback/eurobankcallback.php
 
Upload to your template folder the files:

paymentcompleted.tpl
paymentnotcompleted.tpl

