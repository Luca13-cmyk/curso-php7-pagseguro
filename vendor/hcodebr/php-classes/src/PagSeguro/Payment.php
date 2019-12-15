<?php

namespace Hcode\PagSeguro;

class Payment
{
    private $mode = "default";
    private $currency = "BRL";
    private $extraAmount = 0; // Valor adicional ou desconto
    private $reference = "";
    private $items = [];
    private $sender;
    private $shipping;
    private $method;
    private $creditCard;
    private $bank;
}


?>