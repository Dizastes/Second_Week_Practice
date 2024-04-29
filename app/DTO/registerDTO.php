<?php

namespace App\DTO;

class registerDTO
{
    public $name;
    public $email;
    public $password;
    public $login;

    public function __construct($name, $email, $password, $login)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->login = $login;
    }
}