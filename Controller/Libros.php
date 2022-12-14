<?php
    class Libros extends Controllers{
        public function __construct()
        {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url());
        }
            parent::__construct();

        }
        public function libros()
        {
            $libro = $this->model->selectLibro();
            $materias = $this->model->selectMateria();
            $editorial = $this->model->selectEditorial();
            $autor = $this->model->selectAutor();
            $data = ['libros' => $libro, 'materias' => $materias, 'editoriales' => $editorial, 'autores' => $autor];
            $this->views->getView($this, "listar", $data);
        }
        public function registrar()
        {
            $titulo = $_POST['titulo'];
            $cantidad = $_POST['cantidad'];
            $autor = $_POST['autor'];
            $editorial = $_POST['editorial'];
            $anio_edicion = $_POST['anio_edicion'];
            $editorial = $_POST['editorial'];
            $materia = $_POST['materia'];
            $num_pagina = $_POST['num_pagina'];
            $descripcion = $_POST['descripcion'];
            $img = $_FILES['imagen'];
            $imgName = $img['name'];
            $nombreTemp = $img['tmp_name'];
            $fecha = md5(date("Y-m-d h:i:s")) ."_". $imgName;
            $destino = "Assets/images/libros/" . $fecha;
            if ($imgName == null || $imgName == "") {
                $insert = $this->model->insertarLibro($titulo, $cantidad, $autor, $editorial, $anio_edicion, $materia, $num_pagina, $descripcion, "default-avatar.png");
            }else{
                $insert = $this->model->insertarLibro($titulo, $cantidad, $autor ,$editorial, $anio_edicion, $materia, $num_pagina, $descripcion, $fecha);
                if ($insert) {
                    move_uploaded_file($nombreTemp, $destino);
                }
            }
            header("location: " . base_url() . "libros");
            die();
        }
        public function editar()
        {
            $id = $_GET['id'];
            $materias = $this->model->selectMateria();
            $editorial = $this->model->selectEditorial();
            $autor = $this->model->selectAutor();
            $libro = $this->model->editLibro($id);
            $data = ['materias' => $materias, 'editoriales' => $editorial, 'autores' => $autor, 'libro' => $libro];
            if ($data == 0) {
                $this->libros();
            } else {
                $this->views->getView($this, "editar", $data);
            }
        }
        public function modificar()
        {
            $id = $_POST['id'];
            $titulo = $_POST['titulo'];
            $cantidad = $_POST['cantidad'];
            $autor = $_POST['autor'];
            $editorial = $_POST['editorial'];
            $anio_edicion = $_POST['anio_edicion'];
            $editorial = $_POST['editorial'];
            $materia = $_POST['materia'];
            $num_pagina = $_POST['num_pagina'];
            $descripcion = $_POST['descripcion'];
            $img = $_FILES['imagen'];
            $imgName = $img['name'];
            $nombreTemp = $img['tmp_name'];
            $fecha = md5(date("Y-m-d h:i:s")) . "_" . $imgName;
            $destino = "Assets/images/libros/".$fecha;
            $imgAntigua = $_POST['foto'];
            if ($imgName == null || $imgName == "") {
                $actualizar = $this->model->actualizarLibro($titulo, $cantidad, $autor ,$editorial, $anio_edicion, $materia, $num_pagina, $descripcion, $imgAntigua, $id);
            } else {
                $actualizar = $this->model->actualizarLibro($titulo, $cantidad, $autor ,$editorial, $anio_edicion, $materia, $num_pagina, $descripcion, $fecha, $id);
                if ($actualizar) {
                    move_uploaded_file($nombreTemp, $destino);
                    if ($imgAntigua != "default-avatar.png") {
                        unlink("Assets/images/libros/" . $imgAntigua);
                    }
                }
            }
            header("location: " . base_url() . "libros");
            die();
        }
        public function eliminar()
        {
            $id = $_POST['id'];
            $this->model->estadoLibro(0, $id);
            header("location: " . base_url() . "libros");
            die();
        }
        public function reingresar()
        {
            $id = $_POST['id'];
            $this->model->estadoLibro(1, $id);
            header("location: " . base_url() . "libros");
            die();
        }
        public function pdf()
        {
            $libros = $this->model->selectLibro();
            require_once 'Libraries/pdf/fpdf.php';
            $pdf = new FPDF('P', 'mm', 'letter');
            $pdf->AddPage();
            $pdf->SetMargins(10, 10, 10);
            /* Titulo de Pagina */
            $pdf->SetTitle("Libros | MDM");
            /* Pie de Pagina */
            $pdf->SetFont('Arial', 'B', 25);
            $pdf->SetTextColor(194, 194, 194);
            $pdf->Cell(195, 15, utf8_decode('Biblioteca - Municipalidad de Mala'), 0, 1, 'C');
            $pdf->Ln(10);
            /* Titulo de pdf */
            $pdf->SetFont('Arial', 'B', 20);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(195, 10, utf8_decode('Lista de Libros'), 0, 1, 'C');
            $pdf->image(base_url() . "/Assets/img/logo.png", 180, 30, 22, 22, 'PNG');
            $pdf->Ln(10);
            $pdf->SetMargins(10, 10, 10);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetFillColor(84, 159, 12);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(195, 10, "Libros de la Biblioteca", 1, 1, 'C', 1);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(10, 6, utf8_decode('N??'), 1, 0, 'C');
            $pdf->Cell(65, 6, utf8_decode('Titulo'), 1, 0, 'L');
            $pdf->Cell(20, 6, utf8_decode('Imagen'), 1, 0, 'L');
            $pdf->Cell(60, 6, utf8_decode('Autor'), 1, 0, 'L');
            $pdf->Cell(30, 6, utf8_decode('Editorial'), 1, 0, 'L');
            $pdf->Cell(10, 6, 'Cant.', 1, 1, 'C');
            $pdf->SetFont('Arial', '', 10);
            $contador = 1;
            foreach ($libros as $row) {
                $pdf->Cell(10, 22, $contador, 1, 0, 'C');
                $pdf->Cell(65, 22, utf8_decode($row['titulo']), 1, 0, 'L');
                $pdf->Cell(20,22, $pdf->Image(base_url() . 'Assets/images/libros/'.$row['imagen'], $pdf->GetX()+5, $pdf->GetY()+2, 12), 1,0,'C');
                $pdf->Cell(60, 22, utf8_decode($row['autor']), 1, 0, 'L');
                $pdf->Cell(30, 22, utf8_decode($row['editorial']), 1, 0, 'L');
                $pdf->Cell(10, 22, $row['cantidad'], 1, 1, 'C');
                /*$pdf->Image(base_url() . "Assets/images/autor/".$row['imagen'], 180, 30, 22, 22, 'JPG');
                /*$pdf->image(base_url()."Assets/images/autor/".$row['imagen'], 'JPG');
                $pdf->Cell(100,5, $pdf->Image('../galerias/'.$row['portada'], $pdf->GetX()+40, $pdf->GetY()+3, 30), 1,0,'C');
                */
                $contador++;
            }
            $pdf->Output("libros.pdf", "I");
        }
}
