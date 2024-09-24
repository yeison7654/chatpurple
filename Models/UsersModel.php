<?php
class UsersModel extends Mysql
{
    private $id;
    private $username;
    private $password;
    private $email;
    public function __construct()
    {
        parent::__construct();
    }
    public function insert_user($username, $password, $email)
    {
        $sql = "INSERT INTO `users` (`username`, `password`, `email`) 
        VALUES (?, ?, ?);";
        $arrData = array(
            $this->username = $username,
            $this->password = $password,
            $this->email = $email,
        );
        $request = $this->insert($sql, $arrData);
        return $request;
    }
    public function select_user($username, $password){
        $sql = "SELECT*FROM users AS u WHERE u.username="" AND u.`password`=""";
    }
}
