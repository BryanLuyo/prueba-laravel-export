@extends('layout')
@section('title', 'Usuarios')

@section('content')


<div class="container mt-4">

    <div class="row">

        <div class="col-md-12">
           <div class="row">
                <div class="col-md-2"><button type="button" class="btn btn-success" id='insertar_usario'>Nuevo usuario</button></div>
                <div class="col-md-2"><button type="button" class="btn btn-warning" id='modificar_usario'>Editar usuario</button></div>
                <div class="col-md-2"><button type="button" class="btn btn-danger" id='btn_eliminar'>Eliminar usuario</button></div>
                <div class="col-md-2"><button type="button" class="btn btn-secondary" id='activar_usario'>Activar usuario</button></div>
                <div class="col-md-2">
                    <select class="form-control" id="estado_usuarios">
                        <option value="2">Todos</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <input type="text" class="form-control" id="buscar_usuario" placeholder="Buscar Usuario">
                </div>
           </div>
        </div>

        <div class="col-md-12 mt-4">
            <table class="table" id="usuarios_table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Fecha Creacion</th>
                    <th scope="col">Última modificación</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Marcar</th>
                  </tr>
                </thead>
                <tbody id="usuarios_tbody">

                </tbody>
              </table>
        </div>

        <div class="col-md-1">
            <button type="button" class="btn btn-success" id='exportar_excel'>Excel</button>
        </div>

        <div class="col-md-1">
            <button type="button" class="btn btn-warning" id='exportar_pdf'>PDF</button>
        </div>


    </div>
</div>


  <!-- Modal -->
  <div class="modal fade" id="modal_form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Usuarios</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <form id='form_usuario_insert'>
                @csrf
                <div class="form-group">
                  <label for="name_usuario">Usuario</label>
                  <input type="text" class="form-control" id="name_usuario" name="name_usuario">
                </div>

                <div class="form-group">
                    <label for="name_usuario">Fecha de creación</label>
                    <input type="text" class="form-control" id="fecha_creacion_usuario" value="{{ date('m/d/Y') }}" name="fecha_creacion">
                </div>

            </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id='insert_data'>Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal_form_editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Usuarios</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <form id='form_usuario_editar'>
                @csrf
                <div class="form-group">
                  <input type="hidden" class="form-control" id="id_usuario_editar" value="0" name="id_usuario_editar">
                </div>
                <div class="form-group">
                  <label for="name_usuario">Usuario</label>
                  <input type="text" class="form-control" id="name_usuario_editar" name="name_usuario_editar">
                </div>
            </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="guardar_data_editada">Guardar</button>
        </div>
      </div>
    </div>
  </div>




@endsection
