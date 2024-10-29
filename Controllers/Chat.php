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
            echo json_encode(["status" => true, "info" => $request]);
            die();
        }
    }
    //funcion que verifica si tenemos un chat con el usuario o no esta va crear la conversacion
    public function conversation()
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
        $idActivo = $_POST["idUserActivo"];
        $idConversation = $_POST["idConversation"];
        //evaluamos que no envie campos vacios
        if ($idActivo == "" || $idConversation == "") {
            $data = array(
                "title" => "Ocurrio un error inesperado",
                "description" => "No se permite el ingreso de campos vacios",
                "status" => false,
                "datetime" => date("Y-m-d H:i:s"),
            );
            echo json_encode($data);
            die();
        }
        //C1: Obtener la conversacion que tenga el usuario activo
        $request = $this->model->selectChatConversation($idConversation);
        if (count($request) <= 0) {
            echo json_encode(["status" => false, "text" => "No hay conversacion"]);
            die();
        }
        echo json_encode(["status" => true, "data" => $request]);
    }
    //funcion que verifica si tenes convesacione en nuesstro sistema o cuenta
    public function listConversation()
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
        $idUser = strClean($_POST["idUser"]);
        //evaluamos que no envie campos vacios
        if ($idUser == "") {
            $data = array(
                "title" => "Ocurrio un error inesperado",
                "description" => "No se permite el ingreso de campos vacios",
                "status" => false,
                "datetime" => date("Y-m-d H:i:s"),
            );
            echo json_encode($data);
            die();
        }
        //obtenemos las conversacion del modelo
        $request = $this->model->selectConversationUser($idUser);
        if (!is_array($request)) {
            $data = array(
                "title" => "Ocurrio un error inesperado",
                "description" => "No se encontraron conversaciones",
                "status" => false,
                "datetime" => date("Y-m-d H:i:s"),
            );
            echo json_encode($data);
            die();
        }
        echo json_encode(["status" => true, "data" => $request]);
    }
    //funcion que registra el mensaje
    public function sendMessage()
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
        $idUser = strClean($_POST["idUser"]);
        $idConversation = strClean($_POST["idConversation"]);
        $message = strClean($_POST["txtMessage"]);
        //evaluamos que no envie campos vacios
        if ($idUser == "" || $idConversation == "" || $message == "") {
            $data = array(
                "title" => "Ocurrio un error inesperado",
                "description" => "No se permite el ingreso de campos vacios",
                "status" => false,
                "datetime" => date("Y-m-d H:i:s"),
            );
            echo json_encode($data);
            die();
        }
        //registramos el mensaje
        $request = $this->model->insertMessage($idConversation, $idUser,  $message);
        if ($request) {
            echo json_encode(["status" => true]);
            die();
        } else {
            echo json_encode(["status" => false]);
            die();
        }
    }
    //funcion que lista los usuarios del sistema de red social
    public function listUsersSelect()
    {
        //verificar si existe el metodo solicitado
        if (!$_GET) {
            $data = array(
                "title" => "Ocurrio un error inesperado",
                "description" => "Metodo del formulario no encontrado",
                "status" => false,
                "datetime" => date("Y-m-d H:i:s"),
            );
            echo json_encode($data);
            die();
        }
        $request = $this->model->selectUsers();
        echo json_encode(["status" => true, "data" => $request]);
    }
    //funcion que crea la conversacion entre un usuario
    public function createConversation()
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
        $idUser = strClean($_POST["slctUsuarios"]);
        $idUserActivo = $_SESSION["chat"]["infoUSer"]["id"];
        //evaluamos que no envie campos vacios
        if ($idUser == "" || $idUserActivo == "") {
            $data = array(
                "title" => "Ocurrio un error inesperado",
                "description" => "No se permite el ingreso de campos vacios",
                "status" => false,
                "datetime" => date("Y-m-d H:i:s"),
            );
            echo json_encode($data);
            die();
        }
        //registramos el mensaje
        $request = $this->model->insertConversation("conversacion 1");
        $idConversation = $request;
        //registrar el usuario en la conversacion user 1
        $request1 = $this->model->insertConversationUser($idConversation, $idUserActivo);
        //registrar el usuario en la conversacion user 2
        $reques2 = $this->model->insertConversationUser($idConversation, $idUser);
        if ($request1 && $reques2) {
            echo json_encode(["status" => true]);
            die();
        }
    }
}
