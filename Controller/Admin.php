<?php
    class Admin extends Controllers{
        public function __construct()
        {
            session_start();
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url());
            }
            parent::__construct();

        }
        public function admin()
        {
            $libros = $this->model->selectLibros();
            $estudiantes = $this->model->selectEstudiantes();
            $prestamo = $this->model->selectPrestamo();
            $data = ['libros' => $libros, 'estudiantes' => $estudiantes, 'prestamos' => $prestamo];
            $this->views->getView($this, "listar", $data);
        }
        public function registrar()
        {
            $libro = $_POST['libro'];
            $estudiante = $_POST['estudiante'];
            $cantidad = $_POST['cantidad'];
            $fecha_prestamo = $_POST['fecha_prestamo'];
            $fecha_devolucion = $_POST['fecha_devolucion'];
            $observacion = $_POST['observacion'];
            $cantidadActual = $this->model->selectLibrosCantidad($libro);
            if ($cantidadActual['cantidad'] < $cantidad) {
                header("location: " . base_url() . "admin?no_s");
            }else{
                $insert = $this->model->insertarPrestamo($estudiante, $libro, $fecha_prestamo, $fecha_devolucion, $cantidad, $observacion);
                $total = ($cantidadActual['cantidad'] - $cantidad);
                $this->model->actualizarCantidad($total, $libro);
                if ($insert) {
                    header("location: " . base_url() . "admin");
                    die();
                }
            }
            
        }
        public function devolver()
        {
            $id = $_POST['id'];
            $cantidadprestado = $this->model->selectPrestamoCantidad($id);
            $cantidadActual = $this->model->selectLibrosCantidad($cantidadprestado['id_libro']);
            $total = ($cantidadActual['cantidad'] + $cantidadprestado['cantidad']);
            $prest = $this->model->estadoPrestamo("", 0 , $id);
            $actualizado = $this->model->actualizarCantidad($total, $cantidadprestado['id_libro']);
            if ($actualizado && $prest) {
                header("location: " . base_url() . "admin");
                die();
            }
        }
        public function pdf()
        {
        $datos = $this->model->selectDatos();
        $prestamo = $this->model->selectPrestamoDebe();
        require_once 'Libraries/pdf/fpdf.php';
        $pdf = new FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Prestamos | MDM");
        /* Pie de pagina */
        $pdf->SetFont('Arial', 'B', 25);
        $pdf->SetTextColor(194, 194, 194);
        $pdf->Cell(195, 10, utf8_decode('Biblioteca - Municipalidad de Mala'), 0, 1, 'C');
        /* Titulo de  */
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(195, 10, "Prestamos de Libros en la Bibliteca", 0, 1, 'C');
        $pdf->image(base_url() . "/Assets/img/logo.png", 180, 30, 22, 22, 'PNG');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, utf8_decode("Mediante: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, utf8_decode($datos['nombre']), 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, "Correo: ", 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, utf8_decode($datos['correo']), 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, utf8_decode("Teléfono: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, $datos['telefono'], 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, utf8_decode("Dirección: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, utf8_decode($datos['direccion']), 0, 1, 'L');
        $pdf->Ln(5);

        /* ================= TABLA ==================== */
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(84, 159, 12);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(195, 8, "Detalle de Prestamos", 1, 1, 'C', 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(10, 6, utf8_decode('N°'), 1, 0, 'L');
        $pdf->Cell(80, 6, utf8_decode('Estudiantes'), 1, 0, 'L');
        $pdf->Cell(60, 6, 'Libros', 1, 0, 'L');
        $pdf->Cell(30, 6, 'Fecha Prestamo', 1, 0, 'L');
        $pdf->Cell(15, 6, 'Cant.', 1, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $contador = 1;
        foreach ($prestamo as $row) {
            $pdf->Cell(10, 6, $contador, 1, 0, 'L');
            $pdf->Cell(80, 6, utf8_decode($row['nombre']), 1, 0, 'L');
            $pdf->Cell(60, 6, utf8_decode($row['titulo']), 1, 0, 'L');
            $pdf->Cell(30, 6, $row['fecha_prestamo'], 1, 0, 'C');
            $pdf->Cell(15, 6, $row['cantidad'], 1, 1, 'C');
            $contador++;
        }
        $pdf->Output("prestamos.pdf", "I");
        }

        /* ===================================== */
        public function pdfDevuelto()
        {
        $datos = $this->model->selectDatos();
        $prestamo = $this->model->selectPrestamoDevuelto();
        require_once 'Libraries/pdf/fpdf.php';
        $pdf = new FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Reintegrados | MDM");
        /* Pie de pagina */
        $pdf->SetFont('Arial', 'B', 25);
        $pdf->SetTextColor(194, 194, 194);
        $pdf->Cell(195, 10, utf8_decode('Biblioteca - Municipalidad de Mala'), 0, 1, 'C');
        /* Titulo de  */
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(195, 10, "Libros Reintegrados en la Bibliteca", 0, 1, 'C');
        $pdf->image(base_url() . "/Assets/img/logo.png", 180, 30, 22, 22, 'PNG');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, utf8_decode("Mediante: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, utf8_decode($datos['nombre']), 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, "Correo: ", 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, utf8_decode($datos['correo']), 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, utf8_decode("Teléfono: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, $datos['telefono'], 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, utf8_decode("Dirección: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, utf8_decode($datos['direccion']), 0, 1, 'L');
        $pdf->Ln(5);

        /* ================= TABLA ==================== */
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(84, 159, 12);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(195, 8, "Detalle de Libros Reintegrados", 1, 1, 'C', 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(10, 6, utf8_decode('N°'), 1, 0, 'L');
        $pdf->Cell(80, 6, utf8_decode('Estudiantes'), 1, 0, 'L');
        $pdf->Cell(60, 6, 'Libros', 1, 0, 'L');
        $pdf->Cell(30, 6, 'Fecha Prestamo', 1, 0, 'L');
        $pdf->Cell(15, 6, 'Cant.', 1, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $contador = 1;
        foreach ($prestamo as $row) {
            $pdf->Cell(10, 6, $contador, 1, 0, 'L');
            $pdf->Cell(80, 6, utf8_decode($row['nombre']), 1, 0, 'L');
            $pdf->Cell(60, 6, utf8_decode($row['titulo']), 1, 0, 'L');
            $pdf->Cell(30, 6, $row['fecha_prestamo'], 1, 0, 'C');
            $pdf->Cell(15, 6, $row['cantidad'], 1, 1, 'C');
            $contador++;
        }
        $pdf->Output("librosReintegrados.pdf", "I");
        }
    }
