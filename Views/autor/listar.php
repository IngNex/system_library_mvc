<?php encabezado() ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center">Autores de libros</h2>
                    <button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#nuevoLibro"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;Nuevo</button>
                    <div class="table-responsive">
                        <table class="table table-light mt-4" id="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Autor</th>
                                    <th>Foto</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $autor) {
                                    if ($autor['estado'] == 1) {
                                        $estado = '<span class="badge-success p-1 rounded">Activo</span>';
                                    } else {
                                        $estado = '<span class="badge-danger p-1 rounded">Inactivo</span>';
                                    }
                                ?>
                                    <tr>
                                        
                                        <td><?php echo $autor['id']; ?></td>
                                        <td><?php echo $autor['autor']; ?></td>
                                        <td><img class="img-thumbnail" src="<?php echo base_url() ?>Assets/images/autor/<?php echo $autor['imagen']; ?>" width="80"></td>
                                        <td><?php echo $estado; ?></td>
                                        <td>
                                            <div class="text-center">
                                            <a class="btn btn-primary" href="<?php echo base_url() ?>autor/editar?id=<?php echo $autor['id'] ?>"><i class="fas fa-edit"></i></a>
                                            <?php if ($autor['estado'] == 1) { ?>
                                                <form method="post" action="<?php echo base_url() ?>autor/eliminar" class="d-inline eliminar">
                                                    <input type="hidden" name="id" value="<?php echo $autor['id']; ?>">
                                                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            <?php } else { ?>
                                                <form method="post" action="<?php echo base_url() ?>autor/reingresar" class="d-inline reingresar">
                                                    <input type="hidden" name="id" value="<?php echo $autor['id']; ?>">
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
        <div id="nuevoLibro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="my-modal-title">Registro Autor</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url(); ?>autor/registrar" method="post" enctype="multipart/form-data" autocomplete="off">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombre">Autor</label>
                                        <input id="nombre" class="form-control" type="text" name="nombre" required placeholder="Nombre del autor">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <input id="foto" class="form-control" type="file" name="imagen">
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
    </main>
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
                                        <h3 class="title-2 m-b-40">Estado de Autores</h3>
                                    </center>
                                </div>
                                <div class="card-body">
                                    <canvas id="autorEstado"></canvas>
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