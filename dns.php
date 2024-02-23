<?php

// Turn off all error reporting
error_reporting(0);

$domain = $_GET['domain'];
$record_type = $_GET['type'];

// DNS Name Server
// ns1, ns2

$authdns = array('1.1.1.1', '8.8.8.8','9.9.9.9','5.11.11.5','176.103.130.130','208.67.222.220','12.121.117.201','208.91.112.53','87.213.100.113','83.145.86.7','194.209.157.109','164.124.101.2','103.194.240.35');

// use only ns1 because of the update delay from ns2
//$authns = array('159.69.110.93');

$record_type = strtoupper($record_type);

$stack = array();

// DNS abfrage nur wenn Domain gegeben ist
foreach ($authdns as $authns) {
        $result['dns_server'] = $authns;

        if(isset($domain)){
                if(!isset($record_type)){
                        $result['result'] = dns_get_record($domain, DNS_ALL, $authns);
                } elseif($record_type == "AAAA") {
                        $result['result'] = dns_get_record($domain, DNS_AAAA, $authns);
                } elseif($record_type == "A") {
                        $result['result'] = dns_get_record($domain, DNS_A, $authns);
                } elseif($record_type == "TXT") {
                        $result['result'] = dns_get_record($domain, DNS_TXT, $authns);
                } elseif($record_type == "CNAME") {
                        $result['result'] = dns_get_record($domain, DNS_CNAME, $authns);
                } else {
                        $result['result'] = dns_get_record($domain, DNS_ALL, $authns);
                }
                //print_r(json_encode($result));
                array_push($stack, $result);
                //print_r(json_encode($result));
        } else {
                print_r("error - usage https://ipapi.de/dns.php?domain=example.com&type=TXT");
        }
}

$stack = json_encode($stack, JSON_PRETTY_PRINT);
echo "<pre>".$stack."<pre/>";

?>


<html>
    <head>
    <meta http-equiv="refresh" content="10" >
    </head>
</html>

