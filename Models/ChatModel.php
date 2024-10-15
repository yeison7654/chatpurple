<?php
class ChatModel extends Mysql
{
    private $userName;
    public function __construct()
    {
        parent::__construct();
    }

    public function selectUserName(string $userName)
    {
        $sql = "SELECT*FROM users AS u WHERE u.username=?;";
        $arrData = array($this->userName = $userName);
        $request = $this->select($sql, $arrData);
        return $request;
    }
}
