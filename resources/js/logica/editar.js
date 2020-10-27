var id_usarios_editar = new Array();
var id_usuarios_inactivos_editar = new Array();
var validar = new Array();

$('#modificar_usario').click(()=>{


    id_usuarios_inactivos_editar.length = 0;
    id_usarios_editar.length = 0;

    $('input[click_chk="true"]').each(function() {
        if ($(this).prop("checked")) {
            if ($(this).attr("estado") == 0)
                id_usuarios_inactivos_editar.push($(this).val());
            else
                id_usarios_editar.push($(this).val());

        }
    });



    if ( ( id_usuarios_inactivos_editar.length + id_usarios_editar.length ) > 0  )
    {

        if (  ( id_usuarios_inactivos_editar.length + id_usarios_editar.length ) == 1 ) {

             if ( id_usuarios_inactivos_editar.length == 0 ) {

                var nombre = $('#chk_'+id_usarios_editar[0]).attr('nombre_usuario'),
                    id__ = $('#chk_'+id_usarios_editar[0]).val();


                $('#name_usuario_editar').val(nombre);
                $('#id_usuario_editar').val(id__);

                $('#modal_form_editar').modal('show');

             } else {
                 alert('No se puede modificar usuarios inactivos, activar el usuario');
             }

        } else {
            alert('no puede seleccionar mas de un registro');
        }

    } else {
        alert('Seleccionar un registro');
    }
});


$('#guardar_data_editada').click(() => {


    validar.length = 0;
    if ( $('#name_usuario_editar').val().length == 0 )
    validar.push('Ingresar Nombre');


    if (  validar.length == 0 ) {

        $.ajax({
            type: "put",
            url: ruta + '/usuarios/'+$('#id_usuario_editar').val(),
            data: $('#form_usuario_editar').serialize(),
            success: function (response) {

                if ( response.status == 'success' )
                {
                    read_usuarios($("#estado_usuarios option:selected").val());
                    $('#modal_form_editar').modal('hide');
                } else {
                    alert('Usuario ya existe, intente con otro nombre');

                }
            }
        });

    } else {
        alert(validar.toString());
    }



})
