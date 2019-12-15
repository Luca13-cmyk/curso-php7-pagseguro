<?php

// Dados do dono do cartao de credito

namespace Hcode\PagSeguro\CreditCard;

class Holder
{
    private $name;
    private $cpf;
    private $birthDate;
    private $phone;

    public function __construct(
        string $name,
        Document $cpf,
        DateTime $birthDate,
        Phone $phone
    )
    {
        if (!$name) throw new Exception("Informe o nome do comprador.");

        $this->name = $name;
        $this->cpf = $cpf;
        $this->birthDate = $birthDate;
        $this->phone = $phone;
    }

    public function getDOMElement():DOMElement
    {
        $dom = new DOMDocument();

        $holder = $dom->createElement("holder");
        $holder = $dom->appendChild($holder);

        $name = $dom->createElement("name", $this->name);
        $name = $holder->appendChild($name);

        $birthDate = $dom->createElement("birthDate", $this->birthDate->format("d/m/Y"));
        $birthDate = $holder->appendChild($birthDate);

        $documents = $dom->createElement("documents");
        $documents = $holder->appendChild($documents);

        $cpf = $this->cpf->getDOMElement();
        $cpf = $dom->importNode($cpf, true); // O true é para trazer os nós filhos do Objeto Document que está instanciado pelo $cpf.
        $cpf = $documents->appendChild($cpf);

        $phone = $this->phone->getDOMElement();
        $phone = $dom->importNode($phone, true); // O true é para trazer os nós filhos do Objeto Document que está instanciado pelo $phone.
        $phone = $documents->appendChild($phone);

        return $holder;

    }
    
}

?>