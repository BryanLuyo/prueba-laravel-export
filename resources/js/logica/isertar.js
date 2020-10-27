var valida_form = new Array();

$('#insertar_usario').click(()=>{
    $('#modal_form').modal('show');
});

$('#insert_data').click(()=> {

    valida_form.length = 0;

    if ( $('#name_usuario').val().length  == 0  )
        valida_form.push('Ingresar Nombre');


    if ( $('#fecha_creacion_usuario').val().length  == 0  )
        valida_form.push('Seleccione Fecha');


    if ( valida_form.length == 0 ) {

        $.ajax({
            type: "post",
            url: ruta + '/usuarios',
            data: $('#form_usuario_insert').serialize(),
            success: function (response) {

                if ( response.status == 'success' )
                {
                    read_usuarios($("#estado_usuarios option:selected").val());
                    $('#modal_form').modal('hide');
                }
                else
                {
                    alert(response.alert);
                }

            }
        });




    } else {
         alert(valida_form.toString());
    }





})




