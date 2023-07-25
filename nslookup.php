<?php

$domain = $_GET['domain'];
$record_type = $_GET['type'];

// DNS Name Server
// ns1, ns2
/*
authns = array('159.69.110.93', '167.235.231.182');
*/

// use only ns1 because of the update delay from ns2
$authns = array('159.69.110.93');

// DNS abfrage nur wenn Domain gegeben ist
if(isset($domain)){
        if(!isset($record_type)){
                $result = dns_get_record($domain, DNS_ALL, $authns);
        } elseif($record_type == "AAAA") {
                $result = dns_get_record($domain, DNS_AAAA, $authns);
        } elseif($record_type == "A") {
                $result = dns_get_record($domain, DNS_A, $authns);
        } else {
                $result = dns_get_record($domain, DNS_ALL, $authns);
        }
        print_r(json_encode($result));

} else {
        print_r("error");
}

?>
