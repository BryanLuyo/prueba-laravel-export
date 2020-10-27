<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Demo in Laravel 7</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>
    <table class="table" id="usuarios_table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Fecha Creacion</th>
            <th scope="col">Última modificación</th>
            <th scope="col">Estado</th>
          </tr>
        </thead>
        <tbody id="usuarios_tbody">

            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->FechaRegistro }}</td>
                    <td>{{ $usuario->FechaModificación }}</td>
                    <td>{{ $usuario->estado }}</td>
                </tr>
            @endforeach

        </tbody>
      </table>
  </body>
</html>
