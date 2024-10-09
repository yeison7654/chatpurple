<?php
class Logout extends Controllers
{
    public function __construct()
    {
        session_start(["name" => NAME_SESION]);
        session_unset();
        session_destroy();
        header("Location: " . base_url() . "/users/login");
        parent::__construct();
    }
}
