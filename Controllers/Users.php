<?php
class Users extends Controllers
{
    public function __construct()
    {
        session_start(["name" => NAME_SESION]);
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
        $username = strClean($_POST["txtUser"]);
        $email = strClean($_POST["txtMail"]);
        $password1 = strClean($_POST["txtPassword1"]);
        $password2 = strClean($_POST["txtPassword2"]);
        if ($username == "" || $email == "" || $password1 == "" || $password2 == "") {
            $data = array(
                "title" => "Ocurrio un error inesperado",
                "description" => "No se permite el ingreso de campos vacios",
                "status" => false,
                "datetime" => date("Y-m-d H:i:s"),
            );
            echo json_encode($data);
            die();
        }
        if ($password1 != $password2) {
            $data = array(
                "title" => "Ocurrio un error inesperado",
                "description" => "Las contraseñas no son iguales",
                "status" => false,
                "datetime" => date("Y-m-d H:i:s"),
            );
            echo json_encode($data);
            die();
        }
        $password2 = md5($password2);
        $request = $this->model->insert_user($username, $password2, $email);
        if ($request > 0) {
            $data = array(
                "title" => "Correcto",
                "description" => "Registro completado satisfactoriamente",
                "status" => true,
                "datetime" => date("Y-m-d H:i:s"),
            );
            echo json_encode($data);
            die();
        } else {
            $data = array(
                "title" => "Ocurrio un error inesperado",
                "description" => "No se logro completar el registro",
                "status" => false,
                "datetime" => date("Y-m-d H:i:s"),
            );
            echo json_encode($data);
            die();
        }
    }
    public function singIn()
    {
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
        $userName = strClean($_POST["txtUserName"]);
        $userPassword = strClean($_POST["txtPassword"]);
        if ($userName == "" || $userPassword == "") {
            $data = array(
                "title" => "Ocurrio un error inesperado",
                "description" => "No se permite el ingreso de campos vacios",
                "status" => false,
                "datetime" => date("Y-m-d H:i:s"),
            );
            echo json_encode($data);
            die();
        }
        $userPassword = md5($userPassword);
        $request = $this->model->select_user($userName, $userPassword);
        if (!is_array($request)) {
            $data = array(
                "title" => "Ocurrio un error inesperado",
                "description" => "Usuario o contraseña incorrectos/Usuario no creado",
                "status" => false,
                "datetime" => date("Y-m-d H:i:s"),
            );
            echo json_encode($data);
            die();
        }
        if (count($request) > 0) {
            $_SESSION["chat"]["infoUSer"] = $request;
            $data = array(
                "title" => "Correcto",
                "description" => "Inicio de sesion para el usuario {$userName} completado",
                "status" => true,
                "datetime" => date("Y-m-d H:i:s"),
                "url" => base_url() . "/chat",
            );
            echo json_encode($data);
            die();
        }
    }
}
