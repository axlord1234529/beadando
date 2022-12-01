<?php
$options = array(
    'keep_alive' => false,
    //'trace' =>true,
    //'connection_timeout' => 5000,
    //'cache_wsdl' => WSDL_CACHE_NONE,
);
$client = new SoapClient('http://localhost/beadando/server/cookies.wsdl', $options);

$cookies = $client->get_cookies();
echo "<h1> get_cookies() vissza adja az összes süti adatát </h1>";

echo "<pre>";
print_r($cookies['cookies']);
echo "</pre>";

echo "<h1> get_cookie_content('kókuszcsók') vissza adja a paraméterként megadott süti tartalmát</h1>";
$cookies = $client->get_cookie_content("Kókuszcsók");
echo "<pre>";
print_r($cookies['cookie_content']);
echo "</pre>";

echo "<h1> get_cookie_price('kókuszcsók') vissza adja a paraméterként megadott süti árát és egységét</h1>";
$cookies = $client->get_cookie_price("Süni");
echo "<pre>";
print_r($cookies['cookie_price']);
echo "</pre>";


