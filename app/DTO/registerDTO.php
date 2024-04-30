<?php

namespace App\DTO;

class registerDTO
{
    public $f_name;
    public $s_name;
    public $t_name;
    public $password;
    public $login;

    public function __construct($f_name, $s_name, $t_name, $password, $login)
    {
        $this->f_name = $f_name;
        $this->s_name = $s_name;
        $this->t_name = $t_name;
        $this->password = $password;
        $this->login = $login;
    }
}