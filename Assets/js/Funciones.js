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

if (document.getElementById("rolUsuarios")) {
    const action = "usersChart";
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
                var ctx = document.getElementById("rolUsuarios");
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
                        labels: ['desacivo', 'activo'],
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

