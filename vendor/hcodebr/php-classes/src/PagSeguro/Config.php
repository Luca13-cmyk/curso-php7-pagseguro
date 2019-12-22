<?php

namespace Hcode\PagSeguro;

class Config
{
    const SANDBOX = true;
    // ----- Email
    const SANDBOX_EMAIL = "lucanegresco@gmail.com";
    const PRODUCTION_EMAIL = "lucanegresco@gmail.com";
    // ----- Token
    const SANBOX_TOKEN = "3F66D0B8A6F84FA8A9F1ED9C8CB08EBD";
    const PRODUCTION_TOKEN = "c39fead1-38b6-469f-abb9-50e16238360b2b007a814bb383bd90561f73bd65c87355ba-c7b5-4a0b-93c7-85cbfd2d7a26";
    // ----- Sessions
    const SANDBOX_SESSIONS = "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions";
    const PRODUCTION_SESSIONS = "https://ws.pagseguro.uol.com.br/v2/sessions";
    // ----- URL JS
    const SANDBOX_URL_JS = "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";
    const PRODUCTION_URL_JS = "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";
    // Transacao
    const PRODUCTION_URL_TRANSACTION = "https://ws.pagseguro.uol.com.br/v2/transactions";
    const SANDBOX_URL_TRANSACTION = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions";
    // Notifications
    const SANDBOX_URL_NOTIFICATION = "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/";
    const PRODUCTION_URL_NOTIFICATION = "https://ws.pagseguro.uol.com.br/v3/transactions/notifications/";

    // ----- Parcelamentos 
    const MAX_INSTALLMENT_NO_INTEREST = 10; // Maximo de parcelas sem Juros.
    const MAX_INSTALLMENT = 10; // Maximo de parcelas que o site aceita.
    // ----- Notification Url (Notificacao do status do pagamento)
    const NOTIFICATION_URL = "http://hydenadesenvolve-com.umbler.net/payment/notification"; // ROTA definada quando enviamos o pagamento para o PagSeguro.

    public static function getAuthentication():array
    {
        if (Config::SANDBOX === true)
        {
            return [
                "email"=>Config::SANDBOX_EMAIL,
                "token"=>Config::SANBOX_TOKEN
            ];
        }
        else 
        {
            return [
                "email"=>Config::PRODUCTION_EMAIL,
                "token"=>Config::PRODUCTION_TOKEN
            ];
        }
    }
    public static function getUrlSessions():string
    {
        return (Config::SANDBOX === true) ? Config::SANDBOX_SESSIONS : Config::PRODUCTION_SESSIONS;
    }
    public  static function getUrlJS()
    {
        return (Config::SANDBOX === true) ? Config::SANDBOX_URL_JS : Config::PRODUCTION_URL_JS;
    }
    public  static function getUrlTransaction()
    {
        return (Config::SANDBOX === true) ? Config::SANDBOX_URL_TRANSACTION : Config::PRODUCTION_URL_TRANSACTION;
    }

    public  static function getNotificationTransactionURL()
    {
        return (Config::SANDBOX === true) ? Config::SANDBOX_URL_NOTIFICATION : Config::PRODUCTION_URL_NOTIFICATION;
    }

}

?>