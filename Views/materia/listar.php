<?php encabezado() ?>
<div id="layoutSidenav_content">
    <main>
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
    <br>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <center>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <center>
                                        <h3 class="title-2 m-b-40">Estado de Materias</h3>
                                    </center>
                                </div>
                                <div class="card-body">
                                    <canvas id="materialEstado"></canvas>
                                </div>
                            </div>
                        </div>       
                    </center> 
                </div>
            </div>
        </div>
    </main>
    <br>
    <?php pie() ?>
    