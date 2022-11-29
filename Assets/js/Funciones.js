$(document).ready(function () {
    $(".eliminar").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
    $(".reingresar").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Esta seguro de Reingresar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
    $('#buscar_libro').select2({
        dropdownParent: $("#prestar")
    });
    $('#estudiante').select2({
        dropdownParent: $("#prestar")
    });
    $(".devolver").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Estado conforme?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
    $('#alerta').toast('show');
    $('#errorCambioPass').toast('show');
    
});

/*==================== LIBROS EN STOCK ======================*/
if (document.getElementById("stockMinimo")) {
    const action = "sales";
    $.ajax({
        url: 'src/chart.php',
        type: 'POST',
        data: {
            action
        },
        async: true,
        success: function (response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var nombre = [];
                var cantidad = [];
                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i]['titulo']);
                    cantidad.push(data[i]['cantidad']);
                }
                var ctx = document.getElementById("stockMinimo");
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: nombre,
                        datasets: [{
                            data: cantidad,
                            backgroundColor: ['#053cf0', '#ffff00', '#d90098',  '#ff1c00', '#5e022a', '#ff005a', '#ff5800', '#52e358', '#02fafa','#fa3232'],
                        }],
                    },
                });
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}

/*==================== Prestamos de Libros ======================*/
if (document.getElementById("ProductosVendidos")) {
    const action = "polarChart";
    $.ajax({
        url: 'src/chart.php',
        type: 'POST',
        async: true,
        data: {
            action
        },
        success: function (response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var nombre = [];
                var cantidad = [];
                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i]['titulo']);
                    cantidad.push(data[i]['cantidad']);
                }
                var ctx = document.getElementById("ProductosVendidos");
                var myPieChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: nombre,
                        datasets: [{
                            data: cantidad,
                            backgroundColor: ['#ff7300', '#F00100', '#02e8f7', '#f0d662', '#48d4a0', '#e3c30b', '#E36B2C', '#02ab09', '#540202', '#073ceb'],
                        }],
                    },
                });
            }
        },
        error: function (error) {
            console.log(error);

        }
    });
}

/*==================== PERSONAS - CANTIDAD DE NIVEL DE ESTUDIO ======================*/
if (document.getElementById("dataPersonas")) {
    const action = "personasChart";
    $.ajax({
        url: 'src/chart.php',
        type: 'POST',
        async: true,
        data: {
            action
        },
        success: function (response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var nombre = [];
                var cantidad = [];
                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i]['carrera']);
                    cantidad.push(data[i]['cantidad']);
                }
                var ctx = document.getElementById("dataPersonas");
                var myPieChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: nombre,
                        datasets: [{
                            data: cantidad,
                            backgroundColor: [ '#073ceb','#ff7300', '#F00100', '#02ab09', '#540202', '#073ceb','#ff7300', '#F00100','#E36B2C', '#02e8f7', '#f0d662', '#48d4a0', '#e3c30b'],
                        }],
                    },
                });
            }
        },
        error: function (error) {
            console.log(error);

        }
    });
}

/*==================== PERSONAS ESTADO ======================*/
if (document.getElementById("estadoPersona")) {
    const action = "estadoPersonaChart";
    $.ajax({
        url: 'src/chart.php',
        type: 'POST',
        data: {
            action
        },
        async: true,
        success: function (response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var nombre = [];
                var cantidad = [];
                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i]['estado']);
                    cantidad.push(data[i]['cantidad']);
                }
                var ctx = document.getElementById("estadoPersona");

                var myPieChart = new Chart(ctx, {
                    type: 'bar',
                    data: { 
                        labels: ['Inactivo', 'Activo'],
                        datasets: [{
                            data: cantidad,
                            backgroundColor: ['#DC3545', '#28A745', '#d90098',  '#ff1c00', '#5e022a', '#ff005a', '#ff5800', '#52e358', '#02fafa','#fa3232'],
                        }],
                    },
                });
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}

/*==================== ROL DE USUARIO ======================*/
if (document.getElementById("dataUser")) {
    const action = "usuarioChart";
    $.ajax({
        url: 'src/chart.php',
        type: 'POST',
        async: true,
        data: {
            action
        },
        success: function (response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var nombre = [];
                var cantidad = [];
                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i]['rol']);
                    cantidad.push(data[i]['cantidad']);
                }
                var ctx = document.getElementById("dataUser");
                var myPieChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Administrador', 'Supervisor'],
                        datasets: [{
                            label: 'Roles de usuario',
                            data: cantidad,
                            backgroundColor: [ '#28A745','#6C757D'],
                        }],
                    },
                });
            }
        },
        error: function (error) {
            console.log(error);

        }
    });
}

/*==================== ROL DE USUARIO ======================*/
if (document.getElementById("materialEstado")) {
    const action = "materialChart";
    $.ajax({
        url: 'src/chart.php',
        type: 'POST',
        data: {
            action
        },
        async: true,
        success: function (response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var nombre = [];
                var cantidad = [];
                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i]['estado']);
                    cantidad.push(data[i]['cantidad']);
                }
                var ctx = document.getElementById("materialEstado");

                var myPieChart = new Chart(ctx, {
                    type: 'bar',
                    data: { 
                        labels: ['Inactivo', 'Activo'],
                        datasets: [{
                            label: 'Estado de Materia',
                            data: cantidad,
                            backgroundColor: ['#DC3545', '#28A745', '#d90098',  '#ff1c00', '#5e022a', '#ff005a', '#ff5800', '#52e358', '#02fafa','#fa3232'],
                        }],
                    },
                });
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}

/*==================== CANTIDAD DE LIBRO ======================*/
if (document.getElementById("libroCantidad")) {
    const action = "libroChart";
    $.ajax({
        url: 'src/chart.php',
        type: 'POST',
        data: {
            action
        },
        async: true,
        success: function (response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var nombre = [];
                var cantidad = [];
                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i]['titulo']);
                    cantidad.push(data[i]['cantidad']);
                }
                var ctx = document.getElementById("libroCantidad");

                var myPieChart = new Chart(ctx, {
                    type: 'polarArea',
                    data: { 
                        labels: nombre,
                        datasets: [{
                            data: cantidad,
                            backgroundColor: ['#053cf0', '#ffff00', '#d90098',  '#ff1c00', '#5e022a', '#ff005a', '#ff5800', '#52e358', '#02fafa','#fa3232'],
                        }],
                    },
                });
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}

/*==================== ESTADO DE AUTOR ======================*/
if (document.getElementById("autorEstado")) {
    const action = "autorChart";
    $.ajax({
        url: 'src/chart.php',
        type: 'POST',
        data: {
            action
        },
        async: true,
        success: function (response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var nombre = [];
                var cantidad = [];
                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i]['estado']);
                    cantidad.push(data[i]['cantidad']);
                }
                var ctx = document.getElementById("autorEstado");

                var myPieChart = new Chart(ctx, {
                    type: 'bar',
                    data: { 
                        labels: ['Inactivo', 'Activo'],
                        datasets: [{
                            data: cantidad,
                            backgroundColor: ['#DC3545', '#28A745', '#d90098',  '#ff1c00', '#5e022a', '#ff005a', '#ff5800', '#52e358', '#02fafa','#fa3232'],
                        }],
                    },
                });
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}

/*==================== ESTADO DE EDITORIAL ======================*/
if (document.getElementById("editorialEstado")) {
    const action = "editorialChart";
    $.ajax({
        url: 'src/chart.php',
        type: 'POST',
        data: {
            action
        },
        async: true,
        success: function (response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var nombre = [];
                var cantidad = [];
                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i]['estado']);
                    cantidad.push(data[i]['cantidad']);
                }
                var ctx = document.getElementById("editorialEstado");

                var myPieChart = new Chart(ctx, {
                    type: 'bar',
                    data: { 
                        labels: ['Inactivo', 'Activo'],
                        datasets: [{
                            data: cantidad,
                            backgroundColor: ['#DC3545', '#28A745', '#d90098',  '#ff1c00', '#5e022a', '#ff005a', '#ff5800', '#52e358', '#02fafa','#fa3232'],
                        }],
                    },
                });
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}

/*==================== PRESTAMO POR PERSONA ======================*/
if (document.getElementById("personaPrestamo")) {
    const action = "prestamoPersona";
    $.ajax({
        url: 'src/chart.php',
        type: 'POST',
        async: true,
        data: {
            action
        },
        success: function (response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var nombre = [];
                var cantidad = [];
                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i]['nombre']);
                    cantidad.push(data[i]['cantidad']);
                }
                var ctx = document.getElementById("personaPrestamo");
                var myPieChart = new Chart(ctx, {
                    type: 'polarArea',
                    data: {
                        labels: nombre,
                        datasets: [{
                            data: cantidad,
                            backgroundColor: ['#48d4a0', '#e3c30b','#02ab09', '#540202', '#073ceb','#ff7300', '#F00100', '#02e8f7', '#f0d662', '#48d4a0', '#e3c30b', '#E36B2C'],
                        }],
                    },
                });
            }
        },
        error: function (error) {
            console.log(error);

        }
    });
}

/*==================== ESTADO DE Prestamo ======================*/
if (document.getElementById("estadoPrestamo")) {
    const action = "estadoPrestamo";
    $.ajax({
        url: 'src/chart.php',
        type: 'POST',
        data: {
            action
        },
        async: true,
        success: function (response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var nombre = [];
                var cantidad = [];
                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i]['estado']);
                    cantidad.push(data[i]['cantidad']);
                }
                var ctx = document.getElementById("estadoPrestamo");

                var myPieChart = new Chart(ctx, {
                    type: 'bar',
                    data: { 
                        labels: ['Devuelto', 'Prestado'],
                        datasets: [{
                            label: 'Estado de Prestamos',
                            fill: false,
                            data: cantidad,
                            backgroundColor: [ '#28A745','#DC3545'],
                        }],
                    },
                });
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}

/*==================== Prestamos de Libros ======================*/
if (document.getElementById("barPrestamo")) {
    const action = "barPrestamo";
    $.ajax({
        url: 'src/chart.php',
        type: 'POST',
        async: true,
        data: {
            action
        },
        success: function (response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var nombre = [];
                var cantidad = [];
                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i]['titulo']);
                    cantidad.push(data[i]['cantidad']);
                }
                var ctx = document.getElementById("barPrestamo");
                var myPieChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: nombre,
                        datasets: [{
                            type: 'line',
                            label: 'Cantidad',
                            data: cantidad,
                            fill: false,
                            borderColor: 'rgb(54, 162, 235)'
                        },{
                            type: 'bar',
                            label: 'Libros',
                            data: cantidad,
                            borderColor: 'rgb(255, 99, 132)',
                            backgroundColor: ['#48d4a0',  '#02e8f7', '#f0d662', '#ff7300', '#073ceb','#F00100','#28A745', '#540202', '#E36B2C'],
                        }]
                    },
                });
            }
        },
        error: function (error) {
            console.log(error);

        }
    });
}

/*==================== ESTADO DE USUARIO ======================*/
if (document.getElementById("estadoUser")) {
    const action = "estadoUser";
    $.ajax({
        url: 'src/chart.php',
        type: 'POST',
        data: {
            action
        },
        async: true,
        success: function (response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var nombre = [];
                var cantidad = [];
                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i]['estado']);
                    cantidad.push(data[i]['cantidad']);
                }
                var ctx = document.getElementById("estadoUser");

                var myPieChart = new Chart(ctx, {
                    type: 'bar',
                    data: { 
                        labels: ['Inactivo', 'Activo'],
                        datasets: [{
                            label: 'Estado de Usuarios',
                            fill: false,
                            data: cantidad,
                            backgroundColor: [ '#DC3545','#007BFF'],
                        }],
                    },
                });
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}

/*==================== Prestamos de Libros ======================*/
if (document.getElementById("dirCantidad")) {
    const action = "dirCantidad";
    $.ajax({
        url: 'src/chart.php',
        type: 'POST',
        async: true,
        data: {
            action
        },
        success: function (response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var nombre = [];
                var cantidad = [];
                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i]['direccion']);
                    cantidad.push(data[i]['cantidad']);
                }
                var ctx = document.getElementById("dirCantidad");
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: nombre,
                        datasets: [{
                            data: cantidad,
                            backgroundColor: ['#48d4a0', '#e3c30b', '#E36B2C','#02e8f7', '#f0d662',  '#02ab09','#ff7300', '#F00100',  '#540202', '#073ceb'],
                        }],
                    },
                });
            }
        },
        error: function (error) {
            console.log(error);

        }
    });
}
/*
Chart Js
https://www.chartjs.org/docs/latest/charts/mixed.html
*/