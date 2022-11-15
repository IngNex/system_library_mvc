<?php encabezado() ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center">Dashboard</h2>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-warning card-header-icon">
                                    <div class="card-icon">
                                        <i class="fas fa-user-circle fa-2x"></i>
                                    </div>
                                    <a href="usuarios.php" class="card-category text-warning font-weight-bold">
                                        Miembros
                                    </a>
                                    <h3 class="card-title">
                                        <?php 
                                        foreach ($data['usuarios'] as $user) {
                                        echo $user['usuarios'];
                                        } ?>
                                    </h3>
                                </div>
                                <div class="card-footer bg-warning text-white">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-success card-header-icon">
                                    <div class="card-icon">
                                        <i class="fas fa-users fa-2x"></i>
                                    </div>
                                    <a href="clientes.php" class="card-category text-success font-weight-bold">
                                        Personas
                                    </a>
                                    <h3 class="card-title">
                                        <?php 
                                        foreach ($data['personas'] as $pers) {
                                        echo $pers['personas'];
                                        } ?>
                                    </h3>
                                </div>
                                <div class="card-footer bg-secondary text-white">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-danger card-header-icon">
                                    <div class="card-icon">
                                        <i class="fas fa-book fa-2x"></i>
                                    </div>
                                    <a href="productos.php" class="card-category text-danger font-weight-bold">
                                        Libros
                                    </a>
                                    <h3 class="card-title">
                                        <?php 
                                        foreach ($data['libros'] as $libro) {
                                        echo $libro['libros'];
                                        } ?>
                                    </h3>
                                </div>
                                <div class="card-footer bg-primary">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-info card-header-icon">
                                    <div class="card-icon">
                                        <i class="fas fa fa-tasks fa-2x"></i>
                                    </div>
                                    <a href="ventas.php" class="card-category text-info font-weight-bold">
                                        Pretamos
                                    </a>
                                    <h3 class="card-title">
                                        <?php 
                                        foreach ($data['prestamos'] as $pres) {
                                        echo $pres['prestamos'];
                                        } ?>
                                    </h3>
                                </div>
                                <div class="card-footer bg-danger text-white">
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center">Materias de Libros</h2>
                    <button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#nuevoMateria"><i class="fas fa-folder-plus"></i>&nbsp;&nbsp;Nueva Materia</button>
                    <div class="table-responsive">
                        <table class="table table-light mt-4" id="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Materia</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--
                                <?php foreach ($data as $materia) {
                                    if ($materia['estado'] == 1) {
                                        $estado = '<span class="badge-success p-1 rounded">Activo</span>';
                                    } else {
                                        $estado = '<span class="badge-danger p-1 rounded">Inactivo</span>';
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $materia['id']; ?></td>
                                        <td><?php echo $materia['materia']; ?></td>
                                        <td><?php echo $estado; ?></td>
                                        <td>
                                            <div class="text-center">
                                            <a class="btn btn-primary" href="<?php echo base_url() ?>materia/editar?id=<?php echo $materia['id'] ?>"><i class="fas fa-edit"></i></a>
                                            <?php if ($materia['estado'] == 1) { ?>
                                                <form method="post" action="<?php echo base_url() ?>materia/eliminar" class="d-inline eliminar">
                                                    <input type="hidden" name="id" value="<?php echo $materia['id']; ?>">
                                                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            <?php } else { ?>
                                                <form method="post" action="<?php echo base_url() ?>materia/reingresar" class="d-inline reingresar">
                                                    <input type="hidden" name="id" value="<?php echo $materia['id']; ?>">
                                                    <button class="btn btn-success" type="submit"><i class="fas fa-audio-description"></i></button>
                                                </form>
                                            <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                                -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div id="nuevoMateria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-black" id="my-modal-title">Registro Materia</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url(); ?>materia/registrar" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nombre">Materia</label>
                                    <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Ingresar Materia">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Registrar</button>
                                    <button class="btn btn-danger" data-dismiss="modal" type="button">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php pie() ?>