<?php encabezado() ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center">Personas</h2>
                    <button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#nuevoEstudiante"><i class="fas fa-user-plus"></i>&nbsp;Nueva Persona</button>
                    
                    <div class="table-responsive">
                        <table class="table table-light mt-4" id="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Código</th>
                                    <th>DNI</th>
                                    <th>Nombre Completo</th>
                                    <th>Educación</th>
                                    <th>Distrito</th>
                                    <th>Celular</th>
                                    <th>&nbsp;&nbsp;Estado&nbsp;&nbsp;</th>
                                    <th>&nbsp;&nbsp;&nbsp;&nbsp;Accion&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $estudiante) {
                                    if ($estudiante['estado'] == 1) {
                                        $estado = '<span class="badge-success p-1 rounded">Activo</span>';
                                    } else {
                                        $estado = '<span class="badge-danger p-1 rounded">Inactivo</span>';
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $estudiante['id']; ?></td>
                                        <td><?php echo $estudiante['codigo']; ?></td>
                                        <td><?php echo $estudiante['dni']; ?></td>
                                        <td><?php echo $estudiante['nombre']; ?></td>
                                        <td><?php echo $estudiante['carrera']; ?></td>
                                        <td><?php echo $estudiante['direccion']; ?></td>
                                        <td><?php echo $estudiante['telefono']; ?></td>
                                        <td><?php echo $estado; ?></td>
                                        <td>
                                            <div class="text-center">
                                            <a class="btn btn-primary" href="<?php echo base_url() ?>estudiantes/editar?id=<?php echo $estudiante['id'] ?>"><i class="fas fa-edit"></i></a>
                                            <?php if ($estudiante['estado'] == 1) { ?>
                                                <form method="post" action="<?php echo base_url() ?>estudiantes/eliminar" class="d-inline eliminar">
                                                    <input type="hidden" name="id" value="<?php echo $estudiante['id']; ?>">
                                                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            <?php } else { ?>
                                                <form method="post" action="<?php echo base_url() ?>estudiantes/reingresar" class="d-inline reingresar">
                                                    <input type="hidden" name="id" value="<?php echo $estudiante['id']; ?>">
                                                    <button class="btn btn-success" type="submit"><i class="fas fa-audio-description"></i></button>
                                                </form>
                                            <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div id="nuevoEstudiante" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-black" id="my-modal-title">Registro Persona</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url(); ?>estudiantes/registrar" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dni">Dni</label>
                                    <div class="input-group margin">
                                    <input id="dni" class="form-control" type="text" name="dni" required placeholder="Dni" maxlength="8">
                                    <span class="input-group-btn">
                                        <button onclick="Buscar_reniec()" id="btn_reniec" title="Buscar por reniec" type="button" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codigo">Código</label>
                                    <input id="codigo" class="form-control" type="text" name="codigo" required placeholder="Codigo" value="BI">
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombres">Nombres</label>
                                    <input id="nombres" class="form-control" type="text" name="nombres" required placeholder="Nombres" >
                                </div>
                            </div>
                            <!--- ============ NOMBRE COMPLETO NOT VIEW ============== -->
                            <div class="col-md-14">
                                <div class="form-group">
                                    <!--<label for="nombre">Nombre Completo</label>-->
                                    <input style="text-transform:capitalize;" id="nombre" class="form-control" type="hidden" name="nombre" required placeholder="Nombre completo"  >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="apellido_paterno">Apellido Paterno</label>
                                    <input id="apellido_paterno" class="form-control" type="text" name="apellido_paterno" required placeholder="Apellido Paterno" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="apellido_materno">Apellido Materno</label>
                                    <input id="apellido_materno" class="form-control" type="text" name="apellido_materno" required placeholder="Apellido Materno" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="genero">Género</label>
                                    <input id="genero" class="form-control" type="text" name="genero" required placeholder="Género" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="edads">Edad</label>
                                    <input id="edads" class="form-control" type="text" name="edads" required placeholder="Edad" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="civil">Estado Civil</label>
                                    <input id="civil" class="form-control" type="text" name="civil" required placeholder="Estado Civil" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="departamento">Departamento</label>
                                    <input id="departamento" class="form-control" type="text" name="departamento" required placeholder="Departamento" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="provincia">Provincia</label>
                                    <input id="provincia" class="form-control" type="text" name="provincia" required placeholder="Provincia" >
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="distrito">Distrito</label>
                                    <input id="distrito" class="form-control" type="text" name="distrito" required placeholder="Apellido Materno" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input id="direccion" class="form-control" type="text" name="direccion" required placeholder="Dirección">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="carrera">Nivel de Educación</label>
                                    <input id="carrera" class="form-control" type="text" name="carrera" required placeholder="Nivel de Educación">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono">Celular</label>
                                    <input id="telefono" class="form-control" type="text" name="telefono" required placeholder="Teléfono">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Registrar</button>
                                    <button class="btn btn-danger" type="button" data-dismiss="modal">Atras</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <center>
                                <h3 class="title-2 m-b-40">Personas por educación</h3>
                            </center>
                        </div>
                        <div class="card-body">
                            <canvas id="dataPersonas"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <center>
                                <h3 class="title-2 m-b-40">Personas por Distrito</h3>
                            </center>
                        </div>
                        <div class="card-body">
                            <canvas id="dirCantidad"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <center>
                                        <h3 class="title-2 m-b-40">Estado de Personas</h3>
                                    </center>
                                </div>
                                <div class="card-body">
                                    <canvas id="estadoPersona"></canvas>
                                </div>
                            </div>
                        </div>  
            </div>
        </div>
    </main>
    <br>
    <br>
<?php pie() ?>