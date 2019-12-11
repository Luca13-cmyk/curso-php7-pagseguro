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

}

?>