<?php
require 'cookies.php';
require 'WSDLDocument/WSDLDocument.php';
$wsdl = new WSDLDocument('Cookies', "http://localhost/beadando/server/server.php", "http://localhost/beadando/server/");
$wsdl->formatOutput = true;
$wsdlfile = $wsdl->saveXML();
echo $wsdlfile;
file_put_contents ("cookies.wsdl" , $wsdlfile);