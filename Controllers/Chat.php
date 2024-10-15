<?php
class Chat extends Controllers
{
    public function __construct()
    {
        session_start(["name" => NAME_SESION]);
        if (isset($_SESSION["Login"])) {
            if (!$_SESSION["Login"]) {
                header("Location: " . base_url() . "/logout");
            }
        } else {
            header("Location: " . base_url() . "/logout");
        }
        parent::__construct();
    }

    public function chat()
    {
        $data['page_id'] = 3;
        $data['page_tag'] = "Chat";
        $data['page_title'] = "Chat|Users";
        $data['page_name'] = "Chat";
        $data['page_content'] = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, quis. Perspiciatis repellat perferendis accusamus, ea natus id omnis, ratione alias quo dolore tempore dicta cum aliquid corrupti enim deserunt voluptas.";
        $data["page_filejs"] = array(
            "file1" => "Chat/chat.js",
            "file2" => "libraries/chat.js"
        );
        $this->views->getView($this, "chat", $data);
    }
    /**
     * Funciones del chat
     */
    public function searchUsers()
    {
        //verificar si existe el metodo solicitado
        if (!$_POST) {
            $data = array(
                "title" => "Ocurrio un error inesperado",
                "description" => "Metodo del formulario no encontrado",
                "status" => false,
                "datetime" => date("Y-m-d H:i:s"),
            );
            echo json_encode($data);
            die();
        }
        //recibir la informacion enviada
        $userName = strClean($_POST["txtSearchUser"]);
        //evaluamos que no envie campos vacios
        if ($userName == "") {
            $data = array(
                "title" => "Ocurrio un error inesperado",
                "description" => "No se permite el ingreso de campos vacios",
                "status" => false,
                "datetime" => date("Y-m-d H:i:s"),
            );
            echo json_encode($data);
            die();
        }
        //consultamos en el modelo si existen en la bd la informacion
        $request = $this->model->selectUserName($userName);
        if (!is_array($request)) {
            $data = array(
                "title" => "Ocurrio un error inesperado",
                "description" => "Usuario no encontrado",
                "status" => false,
                "datetime" => date("Y-m-d H:i:s"),
            );
            echo json_encode($data);
            die();
        }
        if (count($request) > 0) {
            $data = array(
                "title" => "Correcto",
                "description" => "Usuario econtrado",
                "status" => true,
                "datetime" => date("Y-m-d H:i:s"),
                "url" => base_url() . "/chat",
            );
            echo json_encode($data);
            die();
        }
    }
}
