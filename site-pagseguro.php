<?php 

use \Hcode\Page;
use \Hcode\Model\User;
use \Hcode\Model\Order;
use \Hcode\PagSeguro\Config;
use \Hcode\PagSeguro\Transporter;
use \GuzzleHttp\Client;


$app->get("/payment", function(){
    
    

    User::verifyLogin(false, false);

    $order = new Order();

    $order->getFromSession();

    $years = [];

    for ($y = date('Y'); $y < date('Y') + 14; $y++)
    {
        array_push($years, $y);
    }

    $page = new Page();
    
    $page->setTpl("payment", [
        "order"=>$order->getValues(),
        "msgError"=>Order::getError(),
        "years"=>$years,
        "pagseguro"=>[
            "urlJS"=>Config::getUrlJS(),
            "id"=>Transporter::createSession(),
            "maxInstallmentNoInterest"=>Config::MAX_INSTALLMENT_NO_INTEREST,
            "maxInstallment"=>Config::MAX_INSTALLMENT
        ]

    ]);

});


// $app->get('/payment/pagseguro', function() {

//     // $products = Product::listAll();
    
//     $client = new Client();
//     $response = $client->request('POST', Config::getUrlSessions() . "?" . http_build_query(Config::getAuthentication()), [
//         "verify"=>false
//     ]);

//     #echo $response->getStatusCode(); # 200
//     #echo $response->getHeaderLine('content-type'); # 'application/json; charset=utf8'

//     echo $response->getBody()->getContents(); # '{"id": 1420053, "name": "guzzle", ...}'

// 	// $page = new Page();

// 	// $page->setTpl("pagseguro", [
// 	// 	'products'=>Product::checkList($products)
// 	// ]);

// });

