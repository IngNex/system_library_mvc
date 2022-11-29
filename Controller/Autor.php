<?php
    class Autor extends Controllers{
        public function __construct()
        {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url());
        }
            parent::__construct();

        }
        public function autor()
        {
            $data = $this->model->selectAutor();         
            $this->views->getView($this, "listar", $data);
        }
        public function registrar()
        {
            $autor = $_POST['nombre'];
            $img = $_FILES['imagen'];
            $nombre = $img['name'];
            $nombreTemp = $img['tmp_name'];
            $fecha = md5(date("Y-m-d h:i:s")) . "_" . $nombre;
            $destino = "Assets/images/autor/".$fecha;
            if ($nombre == null || $nombre == "") {
                $insert = $this->model->insertarAutor($autor, "default-avatar.png");
            } else {
                $insert = $this->model->insertarAutor($autor, $fecha);
                if ($insert) {
                    move_uploaded_file($nombreTemp, $destino);
                }
            }
            header("location: " . base_url() . "autor");
            die();
        }
        public function editar()
        {
            $id = $_GET['id'];
            $data = $this->model->editAutor($id);
            if ($data == 0) {
                $this->autor();
            }else{
                $this->views->getView($this, "editar", $data);
            }
        }
        public function modificar()
        {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $img = $_FILES['imagen'];
            $imgName = $img['name'];
            $imgTmp = $img['tmp_name'];
            $fecha = md5(date("Y-m-d h:i:s")) . "_" . $imgName;
            $destino = "Assets/images/autor/".$fecha;
            $imgAntigua = $_POST['foto'];
            
            if ($imgName == null || $imgName == "")  {
                $actualizar = $this->model->actualizarAutor($nombre, $imgAntigua, $id);
            }else{
                $actualizar = $this->model->actualizarAutor($nombre, $fecha, $id);
                if ($actualizar) {
                    move_uploaded_file($imgTmp, $destino);
                    if ($imgAntigua != "default-avatar.png") {
                        unlink("Assets/images/autor/" . $imgAntigua);
                    }
                }
            }
            header("location: " . base_url() . "autor");
            die();
        }
        public function eliminar()
        {
            $id = $_POST['id'];
            $this->model->estadoAutor(0, $id);
            header("location: " . base_url() . "autor");
            die();
        }
        public function reingresar()
        {
            $id = $_POST['id'];
            $this->model->estadoAutor(1, $id);
            header("location: " . base_url() . "autor");
            die();
        }
        public function pdf()
        {
        $datos = $this->model->selectAutor();
        require_once 'Libraries/pdf/fpdf.php';
        $pdf = new FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Autores | MDM");
        /* Pie de pagina */
        $pdf->SetFont('Arial', 'B', 25);
        $pdf->SetTextColor(194, 194, 194);
        $pdf->Cell(195, 10, utf8_decode('Biblioteca - Municipalidad de Mala'), 0, 1, 'C');
        /* Titulo de  */
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(195, 10, "Autores de Libros en la Bibliteca", 0, 1, 'C');
        $pdf->image(base_url() . "/Assets/img/logo.png", 180, 25, 22, 22, 'PNG');
        $pdf->Ln(20);
        /* ================= TABLA ==================== */
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(84, 159, 12);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(195, 8, "Detalle de Autores", 1, 1, 'C', 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(15, 22, utf8_decode('N°'), 1, 0, 'C');
        $pdf->Cell(100, 22, utf8_decode('Autor'), 1, 0, 'C');
        $pdf->Cell(40, 22, 'Imagen', 1, 0, 'C');
        $pdf->Cell(40, 22, 'Estado.', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $contador = 1;
        foreach ($datos as $row) {
            $pdf->Cell(15, 22, $contador, 1, 0, 'C');
            $pdf->Cell(100, 22, utf8_decode($row['autor']), 1, 0, 'C');
            $pdf->Cell(40,22, $pdf->Image(base_url() . 'Assets/images/autor/'.$row['imagen'], $pdf->GetX()+14, $pdf->GetY()+1, 13), 1,0,'C');
            if ($row['estado'] == 1) {
                $pdf->Cell(40, 22, utf8_decode('Inactivo'), 1, 1, 'C');
            } else {
                $pdf->Cell(40, 22, utf8_decode('Activo'), 1, 1, 'C');
            }
            $contador++;
        }
        $pdf->Output("autor.pdf", "I");
        }
}
