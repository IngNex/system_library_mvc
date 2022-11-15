<?php
class Dashboard extends Controllers
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url());
        }
        parent::__construct();
    }
    public function dashboard()
    {
        $users = $this->model->countUsers();
        $personas = $this->model->countPersonas();
        $libros = $this->model->countLibros();
        $prestamo = $this->model->countPrestamos();
        $data = ['usuarios'=> $users,'libros' => $libros, 'personas' => $personas, 'prestamos' => $prestamo];
        $this->views->getView($this, "listar", $data);
    }
}