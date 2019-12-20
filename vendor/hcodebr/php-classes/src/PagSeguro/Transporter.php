<?php

namespace Hcode\PagSeguro;

use \GuzzleHttp\Client;
use Hcode\Model\Order;



Class Transporter 
{
    public static function createSession()
    {
        $client = new Client();

        $response = $client->request('POST', Config::getUrlSessions() . "?" . http_build_query(Config::getAuthentication()), [
            "verify"=>false
        ]);

        $xml = simplexml_load_string($response->getBody()->getContents()); 

        return ((string)$xml->id);


    }

    public static function sendTransaction(Payment $payment)
    {
        $client = new Client();

        // echo $payment->getDOMDocument()->saveXml();
        // exit;

        $response = $client->request('POST', Config::getUrlTransaction() . "?" . http_build_query(Config::getAuthentication()), [
            "verify"=>false, // HTTPS
            'headers'=>[
                'Content-Type'=>'application/xml'
            ],
            'body'=>$payment->getDOMDocument()->saveXml()
        ]);

        $xml = simplexml_load_string($response->getBody()->getContents());

        // var_dump($xml);

        $order = new Order();

        $order->get((int)$xml->reference);

        $order->setPagSeguroTransactionResponse( // Coloca no DATABASE o pedido
            (string)$xml->code,
            (float)$xml->grossAmount,
            (float)$xml->discountAmount,
            (float)$xml->feeAmount,
            (float)$xml->netAmount,
            (float)$xml->extraAmount,
            (string)$xml->paymentLink

        );

        return $xml;


    }
}


?>