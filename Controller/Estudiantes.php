<?php
class Estudiantes extends Controllers
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url());
        }
        parent::__construct();
    }
    public function estudiantes()
    {
        $data = $this->model->selectEstudiante();
        $this->views->getView($this, "listar", $data);
    }
    public function registrar()
    {
        $codigo = $_POST['codigo'];
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $carrera = $_POST['carrera'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $insert = $this->model->insertarEstudiante($codigo, $dni, $nombre, $carrera, $direccion, $telefono);
        if ($insert) {
            header("location: " . base_url() . "estudiantes");
            die();    
        }
    }
    public function editar()
    {
        $id = $_GET['id'];
        $data = $this->model->editEstudiante($id);
        if ($data == 0) {
            $this->estudiantes();
        } else {
            $this->views->getView($this, "editar", $data);
        }
    }
    public function modificar()
    {
        $id = $_POST['id'];
        $codigo = $_POST['codigo'];
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $carrera = $_POST['carrera'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $actualizar = $this->model->actualizarEstudiante($codigo, $dni, $nombre, $carrera, $direccion, $telefono, $id);
        if ($actualizar) {   
            header("location: " . base_url() . "estudiantes"); 
            die();
        }
    }
    public function eliminar()
    {
        $id = $_POST['id'];
        $this->model->estadoEstudiante(0, $id);
        header("location: " . base_url() . "estudiantes");
        die();
    }
    public function reingresar()
    {
        $id = $_POST['id'];
        $this->model->estadoEstudiante(1, $id);
        header("location: " . base_url() . "estudiantes");
        die();
    }
    public function pdf()
    {
        $libros = $this->model->selectEstudiante();
        require_once 'Libraries/pdf/fpdf.php';
        $pdf = new FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Personas | MDM");
        $pdf->SetFont('Arial', 'B', 25);
        $pdf->SetTextColor(194, 194, 194);
        $pdf->Cell(195, 15, utf8_decode('Biblioteca - Municipalidad de Mala'), 0, 1, 'C');
        $pdf->Ln(10);
        /* Titulo de pdf */
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(195, 10, utf8_decode('Lista de Personas'), 0, 1, 'C');
        $pdf->image(base_url() . "/Assets/img/logo.png", 180, 30, 22, 22, 'PNG');
        $pdf->Ln(10);
        $pdf->SetMargins(10, 10, 10);
        /*$pdf->SetTitle("libros");*/
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(84, 159, 12);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(195, 10, "Registro de Personas", 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(10, 6, utf8_decode('N°'), 1, 0, 'C');
        $pdf->Cell(25, 6, utf8_decode('DNI'), 1, 0, 'L');
        $pdf->Cell(100, 6, utf8_decode('Nombre Completo'), 1, 0, 'L');
        $pdf->Cell(30, 6, utf8_decode('Estudio'), 1, 0, 'L');
        $pdf->Cell(30, 6, 'Celular', 1, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $contador = 1;
        foreach ($libros as $row) {
            $pdf->Cell(10, 6, $contador, 1, 0, 'C');
            $pdf->Cell(25, 6, $row['dni'], 1, 0, 'C');
            $pdf->Cell(100, 6, utf8_decode($row['nombre']), 1, 0, 'L');
            $pdf->Cell(30, 6, utf8_decode($row['carrera']), 1, 0, 'C');
            $pdf->Cell(30, 6, utf8_decode($row['telefono']), 1, 1, 'C');
            $contador++;
        }
        $pdf->Output("personas.pdf", "I");
    }
}
?>