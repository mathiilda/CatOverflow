<?php

namespace mabw\Cat;

class AuthHandler
{
    /*
    * Kollar om användaren är inloggad eller inte.
    * Om användaren är inloggad returneras true, annars false.
    */
    public function signedIn()
    {
        if (isset($_SESSION["user"])) {
            return true;
        }

        return false;
    }
}
