var id_usarios = new Array();
var id_usuarios_inactivos = new Array();
var mensaje = "";

$("#btn_eliminar").click(() => {

    id_usarios.length = 0;
    id_usuarios_inactivos.length = 0;
    $('input[click_chk="true"]').each(function() {
        if ($(this).prop("checked")) {
            if ($(this).attr("estado") == 0)
                id_usuarios_inactivos.push($(this).val());
            else id_usarios.push($(this).val());
        }
    });

    if (id_usuarios_inactivos.length == 0) {
        mensaje =
            id_usarios.length > 0
                ? "Se desactivara " + id_usarios.length + " registros"
                : "Debe seleccionanar registros";

        if (confirm(mensaje)) {
            if (id_usarios.length > 0) update_estado("0", id_usarios);
        }
    } else if (id_usuarios_inactivos.length > 0) {
        alert("No se permite eliminar usuarios inactivos, desmarcar");
    } else {
        alert("Debe seleccionanar registros");
    }

});

$("#activar_usario").click(() => {
    id_usarios.length = 0;

    $('input[click_chk="true"]').each(function() {
        if ($(this).prop("checked")) id_usarios.push($(this).val());
    });

    mensaje =
        id_usarios.length > 0
            ? "Se activara " + id_usarios.length + " registros"
            : "Debe seleccionanar registros";

    if (confirm(mensaje)) {
        if (id_usarios.length > 0) update_estado("1", id_usarios);
    }
});

function update_estado(estado, ids) {
    $.get(ruta + "/usuarios/" + estado + "/edit", { ids: ids }, function(
        data,
        textStatus,
        jqXHR
    ) {
        read_usuarios($("#estado_usuarios option:selected").val());
    });
}


/*$consulta = DB::select("CALL reporte(?)",[$this->estado]);
        return $consulta;*/
