WhmcsGatewayModule
==================

Οδηγίες για την εγκατάσταση του module της Εurobank για πληρωμή μέσω Πιστωτικής κάρτας
Version: 2.0
Compatible with WHMCS v6.0 and newer.


1) Αρχικά επικοινωνήτε με τη EuroBank η οποία θα σας ζητήσει 5 urls.
θα δηλώσετε ότι τα url είναι τα εξής:


Post url:                         https://www.mysite.gr/whmcs/viewinvoice.php
PaymentCompleted:                 https://www.mysite.gr/whmcs/paymentcompleted.php
PaymentNotCompleted:                 https://www.mysite.gr/whmcs/paymentnotcompleted.php
Confirmation:                         https://www.mysite.gr/whmcs/confirmccdpay.php
ValidateUrl:                         https://www.mysite.gr/whmcs/modules/gateways/callback/eurobankcallback.php

όπου λέει https://www.mysite.gr/whmcs εσείς θα βάλετε το ακριβές μονοπάτι
που οδηγεί στον φάκελο που έχετε το whmcs


2)Θα ανεβάσετε στον φάκελο whmcs/modules/gateways το αρχείο eurobanklib.php
που θα βρείτε στο zip που έχετε κάνει download


3) Θα μπειτε στο admin του whmcs και θα επιλέξετε: Setup -> Payment Gateways
και θα κάνετε activate το ΕurobankLib
Στη συνέχεια θα πρέπει να κάνετε τις απαραίτητες ρυθμίσεις που θα σας εμφανιστούν
Όλα τα πεδία είναι υποχρεωτικά

Θα χρειαστεί να δώσετε και τα στοιχεία κάποιας βάσης όπου μέσα θα πρέπει να υπάρχουν δύο πίνακες
που είναι απαραίτητοι για να γίνουν με ασφάλεια οι συναλλαγές. (Η δημιουργία των πινάκων γίνεται στο βήμα 4)
Σας προτείνουμε να είναι μια βάση διαφορετική από αυτή του whmcs


4) Για τη δημιουργία των απαραίτητων πινάκων στη βάση.
 
Θα πρέπει να τρέξετε στον browser ένα αρχείο php που δημιουργεί αυτούς τους πίνακες.
Θα πρέπει να ανεβάσετε στον server σας στον φάκελο https://www.mysite.gr/whmcs το αρχείο installdb_eurobank.php
και στη συνέχεια να ανοίξετε ston browser το link https://www.mysite.gr/whmcs/installdb_eurobank.php
Αφού ολοκληρωθεί η προσθήκη παρακαλούμε σβήστε το αρχείο από τον server για λόγους ασφαλείας.

5) Τέλος για να λειτουργήσει σωστά το module θα πρέπει να ανεβάσετε τα παρακάτω αρχεία στον server σας.
https://www.mysite.gr/whmcs/paymentcompleted.php
https://www.mysite.gr/whmcs/paymentnotcompleted.php
https://www.mysite.gr/whmcs/confirmccdpay.php
https://www.mysite.gr/whmcs/modules/gateways/callback/eurobankcallback.php
 
Επίσης στο φάκελο που έχετε το επελεγμένο template σας θα πρέπει να ανεβάσετε τα παρακάτω αρχεία

https://www.mysite.gr/whmcs/templates/default/paymentcompleted.tpl
https://www.mysite.gr/whmcs/templates/default/paymentnotcompleted.tpl

