<?php 

use \Hcode\Page;
use \Hcode\Model\User;
use \Hcode\PagSeguro\Config;
use \GuzzleHttp\Client;


$app->get('/payment/pagseguro', function() {

    // $products = Product::listAll();
    
    $client = new Client();
    $response = $client->request('POST', Config::getUrlSessions() . "?" . http_build_query(Config::getAuthentication()), [
        "verify"=>false
    ]);

    #echo $response->getStatusCode(); # 200
    #echo $response->getHeaderLine('content-type'); # 'application/json; charset=utf8'

    echo $response->getBody()->getContents(); # '{"id": 1420053, "name": "guzzle", ...}'

	// $page = new Page();

	// $page->setTpl("pagseguro", [
	// 	'products'=>Product::checkList($products)
	// ]);

});

