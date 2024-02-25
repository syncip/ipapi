<?php

// Turn off all error reporting
error_reporting(0);

$domain = $_GET['domain'];
$record_type = $_GET['type'];
$reload = $_GET['r'];

// DNS Name Server
// ns1, ns2

$authdns = array('1.1.1.1', '8.8.8.8','9.9.9.9','5.11.11.5','176.103.130.130','208.67.222.220','12.121.117.201','208.91.112.53','87.213.100.113','83.145.86.7','194.209.157.109','164.124.101.2','103.194.240.35');

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
            } elseif($record_type == "MX") {
                	$result['result'] = dns_get_record($domain, DNS_MX, $authns);
        	} else {
                	$result['result'] = dns_get_record($domain, DNS_ALL, $authns);
        	}

        	// Add Data to Array
			array_push($stack, $result);

	} else {
        	print_r("error<br>usage https://ipapi.de/dns.php?domain=example.com&type=TXT&r<br>domain -> Domain name<br>type -> A,AAA,TXT,CNAME,MX<br>r -> Autoreload activated");
        	exit();
	}
}


// Autoreload
if (isset($reload)) {
		echo '<!DOCTYPE html>
	<html>
	<head>
	    <title>autoreload active</title>
	    <meta http-equiv="refresh" content="5">
	</head>
	</html>';
}

// Print Data
$stack = json_encode($stack, JSON_PRETTY_PRINT);
echo "<pre>".$stack."<pre/>";

?>
