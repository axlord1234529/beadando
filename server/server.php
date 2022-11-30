<?php
require("cookies.php");
$server = new SoapServer('cookies.wsdl');
$server->setClass('Cookies');
$server->handle();