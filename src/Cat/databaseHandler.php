<?php

namespace mabw\Cat;

class DatabaseHandler
{
    // Kollar om användaren finns sen tidigare, gör den det returneras true
    // annars false.
    public function checkUser($result, $saveInSession=true)
    {
        $user = $_POST["user"];

        foreach ($result as $u) {
            if ($u->username == $user) {
                if ($saveInSession) {
                    $_SESSION["user"] = $user;
                    $_SESSION["email"] = $u->email;
                    $_SESSION["userId"] = $u->id;
                }
                return true;
            }
        }

        return false;
    }

    // Kollar om användaren finns sen tidigare, gör den det returneras true
    // annars false. Kollar även lösenordet.
    public function checkUserPassword($result)
    {
        $user = $_POST["user"];
        $pass = $_POST["pass"];

        foreach ($result as $u) {
            if ($u->username == $user && $u->password == $pass) {
                $_SESSION["user"] = $user;
                $_SESSION["email"] = $u->email;
                $_SESSION["userId"] = $u->id;
                return true;
            }
        }

        return false;
    }

    public function editUser()
    {
        //Redigera profil
    }

    // public function userInformation()
    // {
    //     //Ta fram användar-information
    // }
}
