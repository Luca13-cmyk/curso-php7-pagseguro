<?php

namespace Hcode\PagSeguro;

use Exception;
use DOMDocument;
use DOMElement;
use Hcode\PagSeguro\CreditCard\Installment;
use Hcode\PagSeguro\CreditCard\Holder;

class CreditCard
{
    private $token;
    private $installment;
    private $holder;
    private $billingAddress; // Fatura do cartao

    public function __construct(
        string $token,
        Installment $installment,
        Holder $holder,
        Address $billingAddress
    )
    {
        if (!$token) throw new Exception("Informe o token do cartão de crédito.");

        $this->token = $token;
        $this->installment = $installment;
        $this->holder = $holder;
        $this->billingAddress = $billingAddress;

    }
    public function getDOMElement():DOMElement
    {
        $dom = new DOMDocument();

        $creditCart = $dom->createElement("creditCart");
        $creditCart = $dom->appendChild($creditCart);

        $token = $dom->createElement("token", $this->token);
        $token = $creditCart->appendChild($token);

        $installment = $this->installment->getDOMElement();
        $installment = $dom->importNode($installment, true); // O true é para trazer os nós filhos do Objeto Document que está instanciado pelo $installment.
        $installment = $creditCart->appendChild($installment);

        $holder = $this->holder->getDOMElement();
        $holder = $dom->importNode($holder, true); // O true é para trazer os nós filhos do Objeto Document que está instanciado pelo $holder.
        $holder = $creditCart->appendChild($holder);

        $billingAddress = $this->billingAddress->getDOMElement("billingAddress"); // Referencia ao $node do objeto Address
        $billingAddress = $dom->importNode($billingAddress, true); // O true é para trazer os nós filhos do Objeto Document que está instanciado pelo $billingAddress.
        $billingAddress = $creditCart->appendChild($billingAddress);


        return $creditCart;

    }
    
}


?>