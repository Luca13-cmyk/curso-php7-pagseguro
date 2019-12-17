<?php

// Entrega / Entregar o produto em tal endereço.


namespace Hcode\PagSeguro;

use Exception;
use DOMDocument;
use DOMElement;


class Shipping
{
    const PAC = 1;
    const SEDEX = 2;
    const OTHER = 3;

    private $address;
    private $type;
    private $cost;
    private $addressRequired;

    public function __construct(
        Address $address,
        float $cost,
        int $type,
        bool $addressRequired = true // <shippingAddressRequired>
    )
    {
        if ($type < 1 || $type > 3) throw new Exception("Número não válido. Informe um tipo de frete válido.");

        $this->address = $address;
        $this->type = $type;
        $this->cost = $cost;
        $this->addressRequired = $addressRequired;

    }

    public function getDOMElement():DOMElement
    {
        $dom = new DOMDocument();

        $shipping = $dom->createElement("shipping");
        $shipping = $dom->appendChild($shipping);

        $address = $this->address->getDOMElement();
        $address = $dom->importNode($address, true); // O true é para trazer os nós filhos do Objeto Document que está instanciado pelo $address.
        $address = $shipping->appendChild($address);

        $cost = $dom->createElement("cost", number_format($this->cost, 2, ".", ""));
        $cost = $shipping->appendChild($cost);

        $type = $dom->createElement("type", $this->type);
        $type = $shipping->appendChild($type);

        $addressRequired = $dom->createElement("addressRequired", ($this->addressRequired) ? "true" : "false");
        $addressRequired = $shipping->appendChild($addressRequired);

        return $shipping;

    }
}


?>