<?php
include("../conexion.php");
if ($_POST['action'] == 'sales') {
    $arreglo = array();
    /*$query = mysqli_query($conexion, "SELECT titulo, cantidad FROM libro WHERE cantidad <= 10 ORDER BY cantidad ASC LIMIT 10;");*/
    $query = mysqli_query($conexion, "SELECT titulo, cantidad FROM libro WHERE cantidad<=10 ORDER BY cantidad ASC LIMIT 10;");
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}


if ($_POST['action'] == 'polarChart') {
    $arreglo = array();
    /* SELECT * FROM prestamo as p INNER JOIN libro as l WHERE p.id=l.id; 
    $query = mysqli_query($conexion, "SELECT l.titulo as titulo, p.cantidad as cantidad FROM prestamo as p INNER JOIN libro as l WHERE p.id=l.id;");*/
    $query = mysqli_query($conexion, "SELECT l.titulo as titulo, SUM(p.cantidad) as cantidad FROM prestamo as p INNER JOIN libro as l WHERE p.id_libro=l.id GROUP BY titulo ORDER BY cantidad ASC;");
    /*$query = mysqli_query($conexion, "SELECT p.codproducto, p.descripcion, d.id_producto, d.cantidad, SUM(d.cantidad) as total FROM producto p INNER JOIN detalle_venta d WHERE p.codproducto = d.id_producto group by d.id_producto ORDER BY d.cantidad DESC LIMIT 5");*/
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}

/* ========== Querys Personas  ======== */
if ($_POST['action'] == 'personasChart') {
    $arreglo = array();
    $query = mysqli_query($conexion, "SELECT carrera , count(*) AS cantidad FROM estudiante GROUP BY carrera;");
    
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}
if ($_POST['action'] == 'estadoPersonaChart') {
    $arreglo = array();
    $query = mysqli_query($conexion, "SELECT estado, count(*) AS cantidad FROM estudiante GROUP BY estado;");
    
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}
if ($_POST['action'] == 'dirCantidad') {
    $arreglo = array();
    $query = mysqli_query($conexion, "SELECT direccion, COUNT(*) as cantidad FROM estudiante GROUP BY direccion;");
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}

/* ========== End Personas  ======== */

/* ========== Querys Usuario  ======== */
if ($_POST['action'] == 'usuarioChart') {
    $arreglo = array();
    $query = mysqli_query($conexion, "SELECT rol , count(*) AS cantidad FROM usuarios GROUP BY rol;");
    
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}

if ($_POST['action'] == 'estadoUser') {
    $arreglo = array();
    $query = mysqli_query($conexion, "SELECT estado , count(*) AS cantidad FROM usuarios GROUP BY estado;");
    
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}
/* ========== Querys Materia  ======== */
if ($_POST['action'] == 'materialChart') {
    $arreglo = array();
    $query = mysqli_query($conexion, "SELECT estado , count(*) AS cantidad FROM materia GROUP BY estado;");
    
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}

/* ========== Querys Libro  ======== */
if ($_POST['action'] == 'libroChart') {
    $arreglo = array();
    $query = mysqli_query($conexion, "SELECT titulo, cantidad FROM libro ORDER BY cantidad;");
    
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}
if ($_POST['action'] == 'estadoLiChart') {
    $arreglo = array();
    $query = mysqli_query($conexion, "SELECT estado, count(*) AS cantidad FROM libro GROUP BY estado;");
    
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}
/* ========== Querys Autor  ======== */

if ($_POST['action'] == 'autorChart') {
    $arreglo = array();
    $query = mysqli_query($conexion, "SELECT estado , count(*) AS cantidad FROM autor GROUP BY estado;");
    
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}

/* ========== Querys Editorial  ======== */
if ($_POST['action'] == 'editorialChart') {
    $arreglo = array();
    $query = mysqli_query($conexion, "SELECT estado , count(*) AS cantidad FROM editorial GROUP BY estado;");
    
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}


/* ========== Querys Prestamo  ======== */
if ($_POST['action'] == 'prestamoPersona') {
    $arreglo = array();
    /*$query = mysqli_query($conexion, "SELECT e.nombre, p.cantidad FROM prestamo as p INNER JOIN estudiante as e WHERE p.id_estudiante=e.id;");*/
    $query = mysqli_query($conexion, "SELECT e.nombre, p.cantidad,p.estado FROM prestamo as p INNER JOIN estudiante as e WHERE p.id_estudiante=e.id AND p.estado=1;");
    
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}


if ($_POST['action'] == 'estadoPrestamo') {
    $arreglo = array();
    /*$query = mysqli_query($conexion, "SELECT p.estado, COUNT(*) as cantidad FROM prestamo as p INNER JOIN libro as l WHERE p.id=l.id GROUP BY estado;");*/
    $query = mysqli_query($conexion, "SELECT p.estado, COUNT(*) as cantidad FROM prestamo as p GROUP BY estado;");
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}

if ($_POST['action'] == 'barPrestamo') {
    $arreglo = array();
    $query = mysqli_query($conexion, "SELECT l.titulo as titulo, SUM(p.cantidad) as cantidad FROM prestamo as p INNER JOIN libro as l WHERE p.id_libro=l.id GROUP BY titulo;");
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}


?>


