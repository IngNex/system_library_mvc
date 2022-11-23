<?php
include("../conexion.php");
if ($_POST['action'] == 'sales') {
    $arreglo = array();
    /*$query = mysqli_query($conexion, "SELECT titulo, cantidad FROM libro WHERE cantidad <= 10 ORDER BY cantidad ASC LIMIT 10;");*/
    $query = mysqli_query($conexion, "SELECT titulo, cantidad FROM libro LIMIT 10");
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}
if ($_POST['action'] == 'polarChart') {
    $arreglo = array();
    /* SELECT * FROM prestamo as p INNER JOIN libro as l WHERE p.id=l.id; */
    $query = mysqli_query($conexion, "SELECT l.titulo as titulo, p.cantidad as cantidad FROM prestamo as p INNER JOIN libro as l WHERE p.id=l.id;");
    /*$query = mysqli_query($conexion, "SELECT p.codproducto, p.descripcion, d.id_producto, d.cantidad, SUM(d.cantidad) as total FROM producto p INNER JOIN detalle_venta d WHERE p.codproducto = d.id_producto group by d.id_producto ORDER BY d.cantidad DESC LIMIT 5");*/
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}
if ($_POST['action'] == 'personasChart') {
    $arreglo = array();
    $query = mysqli_query($conexion, "SELECT carrera , count(*) AS cantidad FROM estudiante GROUP BY carrera;");
    
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}

// Desfasado
if ($_POST['action'] == 'usersChart') {
    $arreglo = array();
    $query = mysqli_query($conexion, "SELECT rol , count(*) AS cantidad FROM usuarios GROUP BY rol;");
    
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}

if ($_POST['action'] == 'materialChart') {
    $arreglo = array();
    $query = mysqli_query($conexion, "SELECT estado , count(*) AS cantidad FROM materia GROUP BY estado;");
    
    while ($data = mysqli_fetch_array($query)) {
        $arreglo[] = $data;
    }
    echo json_encode($arreglo);
    die();
}
//
?>