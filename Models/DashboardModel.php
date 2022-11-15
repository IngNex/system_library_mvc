<?php
class DashboardModel extends Mysql{
    public $id, $ruc, $nombre, $telefono, $direccion;
    public function __construct()
    {
        parent::__construct();
    }
    public function countUsers()
    {
        $sql = "SELECT count('id') as usuarios FROM usuarios";
        $res = $this->select_all($sql);
        return $res;
    }
    public function countPersonas()
    {
        $sql = "SELECT count('id') as personas FROM estudiante";
        $res = $this->select_all($sql);
        return $res;
    }
    public function countLibros()
    {
        $sql = "SELECT count('id') as libros FROM libro";
        $res = $this->select_all($sql);
        return $res;
    }
    public function countPrestamos()
    {
        $sql = "SELECT count('id') as prestamos FROM prestamo";
        $res = $this->select_all($sql);
        return $res;
    }
}