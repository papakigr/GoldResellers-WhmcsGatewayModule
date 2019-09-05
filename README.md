Eurobank WhmcsGatewayModule
===========================

Gateway Module for payments via Eurobank
Version: 4.0

English
=======
Compatible with WHMCS v6.0 and newer, Eurobank Cardlink Payment Gateway - Redirect Model v1.0 and newer. Works with 3D Secure transactions


1) You have to have account in Eurobank. 

    Eurobank requests 2 urls. The 2 urls are the following 
    
    PaymentCompleted:                 https://www.mysite.gr/whmcs/modules/gateways/callback/eurobankreturn.php?result=success
    PaymentNotCompleted:                 https://www.mysite.gr/whmcs/modules/gateways/callback/eurobankreturn.php?result=failure
    
    where https://www.mysite.gr/whmcs is your whmcs folder destination
2) Upload the file  modules/gateways/eurobanklib.php in the folder https://www.mysite.gr/whmcs/modules/gateways 

3) Upload the file  modules/gateways/callback/eurobankreturn.php in the folder https://www.mysite.gr/whmcs/modules/gateways/callback

4) Login to whmcs admin panel kai select : Setup -> Payment Gateways
activate  Εurobank module
Then fill all the required fields with information which is provided by Eurobank
All fields are required






Greek
=====
Συμβατό με WHMCS v6.0 και νεότερο, Eurobank Cardlink Payment Gateway - Redirect Model v1.0 και νεότερο. Υποστηρίζει συναλλαγές 3D Secure.


Οδηγίες για την εγκατάσταση του module της Εurobank για πληρωμή μέσω Πιστωτικής κάρτας


1) Αρχικά επικοινωνήτε με τη EuroBank η οποία θα σας ζητήσει 2 urls.
    θα δηλώσετε ότι τα url είναι τα εξής:
    
    PaymentCompleted:                 https://www.mysite.gr/whmcs/modules/gateways/callback/eurobankreturn.php?result=success
    PaymentNotCompleted:                 https://www.mysite.gr/whmcs/modules/gateways/callback/eurobankreturn.php?result=failure
    
    όπου λέει https://www.mysite.gr/whmcs εσείς θα βάλετε το ακριβές μονοπάτι
    που οδηγεί στον φάκελο που έχετε το whmcs

2) Θα ανεβάσετε στον φάκελο https://www.mysite.gr/whmcs/modules/gateways το αρχείο modules/gateways/eurobanklib.php
που θα βρείτε στο zip που έχετε κάνει download

3) Θα ανεβάσετε στον φάκελο https://www.mysite.gr/whmcs/modules/gateways/callback το αρχείο modules/gateways/callback/eurobankreturn.php
που θα βρείτε στο zip που έχετε κάνει download

4) Θα μπειτε στο admin του whmcs και θα επιλέξετε: Setup -> Payment Gateways
και θα κάνετε activate το Εurobank
Στη συνέχεια θα πρέπει να κάνετε τις απαραίτητες ρυθμίσεις που θα σας εμφανιστούν
Όλα τα πεδία είναι υποχρεωτικά





