function Buscar_reniec() {
    var dni = $("#dni").val();
    var input = document.getElementById('dni');
    
    if(input.value.length < 8) {
        $('#dni').focus();
        $("#dni").removeClass('is-valid').addClass("is-invalid");
        return Swal.fire("Mensaje de Advertencia","El campo <b>dni</b>  debe tener como minimo 8 d&iacute;gitos","warning");  
    }
    else{
        $("#dni").removeClass('is-invalid').addClass("is-valid");
    }
    $.ajax({
        url:'https://apiperu.net.pe/api/dni/'+dni,
        type:'GET',
        headers: { 
            'Authorization':'Bearer PUdDnC9j4bYdfEu5RGT7V0g3upwxayhnNMzoTN8DLqSE4XqKSA',
            'Content-Type': 'application/json' ,
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
    .done(function(resp) {
        let resp1 = resp['data'];
        if (resp1['nombres']!=undefined) {
            //$("#txtdni").prop('disabled',true);
            //$("#btn_reniec").prop('disabled',true);
            $("#nombre").val(resp1['nombre_completo'].replace("'", ""));
            $("#direccion").val(resp1['direccion'].replace("'", ""));
            /*$("#txtnombre").val(resp1['nombres'].replace("'", ""));
            $("#txtapepat").val(resp1['apellido_paterno'].replace("'", ""));
            $("#txtapemat").val(resp1['apellido_materno'].replace("'", ""));*/
        }else{
            $("#nombre").val("");
            $("#direccion").val("");
            /*$("#txtnombre").val("");
            $("#txtapepat").val("");
            $("#txtapemat").val("");*/
            Swal.fire("Mensaje de Advertencia","<b style='color:#9B0000'>Lo sentimos el dni ingresado no se encuentro en los archivos de la reniec</b>","warning");
        }
    })
    .fail(function( jqXHR, textStatus, errorThrown){
        if (jqXHR.status === 0) {
            Swal.fire("Mensaje de Error","<b>No se pudo procesar la solicitud,</b><b style='color:#9B0000;'>SIN ACCESO A INTERNET</b>","error");
        }
        if (jqXHR.status === 401) {
            Swal.fire({
                title: "Mensaje de Advertencia",
                html: "<b style='color:#9B0000;font-size:20px'>Acceso no autorizado!!!</b><br><b style='font-size:14px'><b style='color:#9B0000;'>Membres&iacute;a vencida</b>, Para mayor informaci&oacute;n comun&iacute;quese con su proveedor</b>",
                imageUrl: "img/reniec.png",
                imageWidth: 120,
                imageHeight: 115,
                imageAlt: "Cargando...",
            });
        }
    })
}