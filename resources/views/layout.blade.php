<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="{{ url('/css/app.css') }}" />
        <link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
        <title>App - @yield('title')</title>
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>

        <script>
            let ruta = "{{ url('/') }}";
        </script>
        <script src="{{ url('/js/app.js') }}"></script>
        <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
        <script>
            $(function() {
                read_usuarios(2);

                $('#fecha_creacion_usuario').datepicker({
                    format: 'mm/dd/yyyy',
                    language: "es",
                    autoclose: true
                });

                $("#estado_usuarios").change(() => {
                    var estado = $("#estado_usuarios option:selected").val();
                    read_usuarios(estado);
                });


                $('#buscar_usuario').keyup(()=> {
                      read_usuarios($("#estado_usuarios option:selected").val());

                });

                $('#exportar_excel').click(()=> {
                    window.open(ruta + '/excel/'+$("#estado_usuarios option:selected").val(), '_blank');
                });


                $('#exportar_pdf').click(()=> {
                    window.open(ruta + '/pdf/'+$("#estado_usuarios option:selected").val(), '_blank');
                });

            });

            function read_usuarios(estado) {

                var find_users = ( $('#buscar_usuario').val().length > 0 ) ? $('#buscar_usuario').val() : "-";

                $.ajax({
                    type: "GET",
                    url: ruta + "/read/" + estado,
                    data : { usuario : find_users},
                    dataType: "json",
                    success: function(response) {
                        if (response.status == "success") {
                            var html = "",
                                color_fondo = "";

                            if (response.data.length) {
                                $.each(response.data, function(i, item) {
                                    color_fondo =
                                        item.estado == "Inactivo"
                                            ? "style='background: #ef9a9a;'"
                                            : "";
                                    html +=
                                        "<tr id='tr_" +
                                        item.id +
                                        "' " +
                                        color_fondo +
                                        ">";
                                    html += "<td>" + (i + 1) + "</td>";
                                    html += "<td>" + item.name + "</td>";
                                    html +=
                                        "<td>" + item.fec_registro + "</td>";
                                    html +=
                                        "<td>" +
                                        item.fec_modificacion +
                                        "</td>";
                                    html += "<td>" + item.estado + "</td>";
                                    html +=
                                        "<td><input type='checkbox' estado='"+item.estado_tf+"' nombre_usuario='"+item.name+"' click_chk='true' value='" +
                                        item.id +
                                        "' id_usuario = '" +
                                        item.id +
                                        "' id='chk_" +
                                        item.id +
                                        "'></td>";
                                    html += "<tr/>";
                                });
                            } else {
                                html += "<tr id='tr_no_data'>";
                                html +=
                                    "<td colspan='5'><center>No se encontro registro</center></td>";
                                html += "<tr/>";
                            }

                            $("#usuarios_tbody").html(html);

                            console.log(response);
                        }
                    }
                });
            }
        </script>
    </body>
</html>
