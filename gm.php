<?php

if (count($argv) == 1) {
    exit('Argument or GTFO!');
}

unset($argv[0]);
$command = '';
foreach ($argv as $arg) {
    $command .= " $arg";
}
$command = trim($command);
if (substr($command, 0, 1) == '.') {
    $command = substr($command, 1, strlen($command)-1);
}

$soapUsername = 'username';
$soapPassword = 'password';
$soapHost = '127.0.0.1';
$soapPort = '7878';

$client = new \SoapClient(NULL, array(
    'location' => "http://$soapHost:$soapPort/",
    'uri'      => 'urn:MaNGOS',
    'style'    => SOAP_RPC,
    'login'    => $soapUsername,
    'password' => $soapPassword,
));

$result = $client->executeCommand(new \SoapParam($command, 'command'));

echo $result;
