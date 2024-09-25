<?php
class Chat extends Controllers
{
    public function __construct()
    {
        session_start(["name" => NAME_SESION]);
        parent::__construct();
    }

    public function chat()
    {
        $data['page_id'] = 3;
        $data['page_tag'] = "Chat";
        $data['page_title'] = "Chat|Users";
        $data['page_name'] = "Chat";
        $data['page_content'] = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, quis. Perspiciatis repellat perferendis accusamus, ea natus id omnis, ratione alias quo dolore tempore dicta cum aliquid corrupti enim deserunt voluptas.";
        $data["page_filejs"] = "Chat/chat.js";
        $this->views->getView($this, "chat", $data);
    }
}
