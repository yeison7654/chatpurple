<?php
class ChatModel extends Mysql
{
    private $userName;
    private $idUser;
    private $idConversation;
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
    //modelo que obtiene las conversacion de un usuario
    public function selectConversationUser(int $idUser)
    {
        $this->idUser = $idUser;
        $sql = "SELECT u.username, cu.user_id,c.id,c.`name` FROM conversation_users AS cu
                INNER JOIN conversations AS c ON c.id=cu.conversation_id
                INNER JOIN users AS u ON u.id=cu.user_id
                WHERE cu.user_id={$this->idUser};";
        $request = $this->select_all($sql);
        return $request;
    }
    //modelo que obtiene los chats de la conversacion seleccionada
    public function selectChatConversation(int $id)
    {
        $this->idConversation = $id;
        $sql = "SELECT m.id,m.conversation_id,m.user_id,m.content,m.sent_at,u.username FROM messages AS m 
                INNER JOIN users AS u ON u.id=m.user_id
                WHERE m.conversation_id={$this->idConversation}";
        $request = $this->select_all($sql);
        return $request;
    }
}
