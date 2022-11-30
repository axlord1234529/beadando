<?php
$options = array(
    'keep_alive' => false,
    //'trace' =>true,
    //'connection_timeout' => 5000,
    //'cache_wsdl' => WSDL_CACHE_NONE,
);
$client = new SoapClient('http://localhost/beadando/server/cookies.wsdl', $options);

$cookies = $client->get_cookies();
echo "<pre>";
print_r($cookies['cookies']);
echo "</pre>";

$cookies = $client->get_cookie_content("Kókuszcsók");
echo "<pre>";
print_r($cookies['cookie_content']);
echo "</pre>";

$cookies = $client->get_cookie_price("Süni");
echo "<pre>";
print_r($cookies['cookie_price']);
echo "</pre>";


