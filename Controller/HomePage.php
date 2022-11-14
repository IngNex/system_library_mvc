<?php
class HomePage extends Controllers
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: ".base_url());
        }
        parent::__construct();
    }
    public function listar()
    {
        $data = $this->model->selectUsuarios();
        $this->views->getView($this, "listar", $data);
    }
}