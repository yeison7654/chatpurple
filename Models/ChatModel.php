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
        $this->userName = $userName;
        $sql = 'SELECT u.id,u.username,u.email FROM users AS u 
        WHERE u.username LIKE "%' . $this->userName . '%" OR 
        u.email LIKE "%' . $this->userName . '%";';
        $request = $this->select_all($sql);
        return $request;
    }
}
