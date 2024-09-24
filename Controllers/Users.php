<?php
class Users extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $data['page_id'] = 2;
        $data['page_tag'] = "Users";
        $data['page_title'] = "Login|Users";
        $data['page_name'] = "Users";
        $data['page_content'] = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, quis. Perspiciatis repellat perferendis accusamus, ea natus id omnis, ratione alias quo dolore tempore dicta cum aliquid corrupti enim deserunt voluptas.";
        $data["page_filejs"] = "Users/login.js";
        $this->views->getView($this, "login", $data);
    }

    public function saveUsers()
    {
        $username = $_POST["txtUser"];
        $email = $_POST["txtMail"];
        $password2 = $_POST["txtPassword2"];
        $request = $this->model->insert_user($username, $password2, $email);
        echo json_encode($request);
    }
}
