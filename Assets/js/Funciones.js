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
                    nombre.push(data[i]['nombre']);
                    cantidad.push(data[i]['id']);
                }
                var ctx = document.getElementById("stockMinimo");
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: nombre,
                        datasets: [{
                            data: cantidad,
                            backgroundColor: ['#024A86', '#E7D40A', '#581845', '#C82A54', '#EF280F', '#8C4966', '#FF689D', '#E36B2C', '#69C36D', '#23BAC4'],
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
        url: 'chart.php',
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
                    nombre.push(data[i]['descripcion']);
                    cantidad.push(data[i]['cantidad']);
                }
                var ctx = document.getElementById("ProductosVendidos");
                var myPieChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: nombre,
                        datasets: [{
                            data: cantidad,
                            backgroundColor: ['#C82A54', '#EF280F', '#23BAC4', '#8C4966', '#FF689D', '#E7D40A', '#E36B2C', '#69C36D', '#581845', '#024A86'],
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