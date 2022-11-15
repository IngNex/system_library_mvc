<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="<?php echo base_url(); ?>Assets/img/icon.png" type="image/png">
    <title>SysBiblioteca</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>Assets/css/styles.css" id="theme-stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>Assets/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>Assets/css/dataTables.bootstrap4.min.css">
    
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
        <div class="text-center"><a class="navbar-brand" href="<?php echo base_url(); ?>admin/listar">Sys<i class="fas fa-paper-plane"></i>Biblioteca | MDM</a></div>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars fa-lg"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-capitalize" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle fa-lg"></i> <?php echo $_SESSION['nombre']; ?></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?php echo base_url(); ?>usuarios/perfil">
                        <i class="fas fa-user-secret fa-lg"></i>&nbsp;&nbsp;Perfil</a>
                        
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>usuarios/salir"><i class="fas fa-sign-in-alt fa-lg"></i>&nbsp;&nbsp;Salir&nbsp;</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion" id="sidenavAccordion"><!--<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">-->
                <div class="sb-sidenav-menu">
                    <div class="nav">
                    <!--Item Home-->
                        <h4>
                            <a class="nav-link active" href="<?php echo base_url(); ?>dashboard"><!--homepage/listar-->
                                <div class="sb-nav-link-icon"><i class="fas fa-home fa-lg"></i>
                                </div>
                                Home
                            </a>
                        </h4>
                    <!--End Home-->

                    <!--Item Usuarios-->
                    <?php if ($_SESSION['rol'] == 1) { ?>
                        <h4>
                            <a class="nav-link collapsed active" href="<?php echo base_url(); ?>/usuarios" data-toggle="collapse" data-target="#collapseUser" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-user fa-lg"></i></div>
                            Usuarios
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down fa-lg" style="color: #fff;"></i></div>
                            </a>
                        </h4>
                            <div class="collapse" id="collapseUser" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <h5>
                                    <a class="nav-link active" href="<?php echo base_url(); ?>usuarios/listar"><div class="sb-nav-link-icon"><i class="fas fa-user fa-lg"></i>
                                    </div>Usuario
                                    </a>
                                    </h5>
                                    <h4>
                                    <a class="nav-link active" href="<?php echo base_url(); ?>configuracion/listar"><div class="sb-nav-link-icon"><i class="fas fa-tools fa-lg"></i>
                                    </div>Biblioteca
                                    </a>
                                    </h4>
                                </nav>
                            </div>
                            <!--<a class="nav-link active" href="<?php echo base_url(); ?>usuarios/listar">
                                <div class="sb-nav-link-icon"><i class="fas fa-user fa-lg"></i>
                                </div>
                                Usuarios
                            </a>
                            <a class="nav-link active" href="<?php echo base_url(); ?>configuracion/listar">
                                <div class="sb-nav-link-icon"><i class="fas fa-tools fa-lg"></i>
                                </div>
                                Configuración
                            </a>-->
                        <?php } ?>
                    <!--End Usuarios-->

                    <!--Item Personas-->
                        <h4>
                            <a class="nav-link active" href="<?php echo base_url(); ?>estudiantes">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-graduate fa-lg"></i>
                                </div>
                                Personas
                            </a>
                        </h4>
                    <!--End Personas-->

                    <!--Item Materiales-->
                        <h4>
                            <a class="nav-link active" href="<?php echo base_url(); ?>materia">
                                <div class="sb-nav-link-icon"><i class="fas fa-chalkboard fa-lg"></i>
                                </div>
                                Materias
                            </a>
                        </h4>
                    <!--End Materiales-->

                    <!--Item Libros-->
                    <h4>
                            <a class="nav-link collapsed active" href="<?php echo base_url(); ?>/libros" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-university fa-lg"></i></div>
                                Libros
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down fa-lg" style="color: #fff;"></i></div>
                            </a>
                        </h4>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <h5>
                                <a class="nav-link active" href="<?php echo base_url(); ?>libros">
                                    <div class="sb-nav-link-icon"><i class="fas fa-book fa-lg"></i></div>
                                    Libro
                                </a>
                                </h5>
                                <h5>
                                <a class="nav-link active" href="<?php echo base_url(); ?>autor">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user-edit fa-lg"></i></div>
                                    Autor
                                </a>
                                </h5>
                                <h5>
                                <a class="nav-link active" href="<?php echo base_url(); ?>editorial">
                                    <div class="sb-nav-link-icon"><i class="fas fa-marker fa-lg"></i></div>
                                    Editorial
                                </a>
                                </h5>
                            </nav>
                        </div>
                    <!--End Libros-->

                    <!--Item Prestamo-->
                        <?php if ($_SESSION['rol'] == 1) { ?>
                            <h4>
                                <a class="nav-link active" href="<?php echo base_url(); ?>admin/listar">
                                <div class="sb-nav-link-icon"><i class="fas fa-tasks fa-lg"></i></div>Prestamo
                                </a>
                            </h4>
                        <?php } ?>
                    <!--End Prestamo-->
                    
                    <!--Item Reportes-->
                        <h4>
                            <a class="nav-link collapsed active" href="<?php echo base_url(); ?>/libros" data-toggle="collapse" data-target="#collapseEst" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-pdf fa-lg"></i></div>
                                Reportes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down fa-lg" style="color: #fff;"></i></div>
                            </a>
                        </h4>
                        <div class="collapse" id="collapseEst" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <h5>
                                    <a class="nav-link active" target="_blank" href="<?php echo base_url(); ?>estudiantes/pdf">
                                        <div class="sb-nav-link-icon"><i class="fas fa-address-book fa-lg"></i></div>
                                        Personas
                                    </a>
                                </h5>
                                <h5>
                                    <a class="nav-link active" target="_blank" href="<?php echo base_url(); ?>libros/pdf">
                                        <div class="sb-nav-link-icon"><i class="fas fa-file-invoice fa-lg"></i></div>
                                        Libros
                                    </a>
                                </h5>
                                <h5>
                                    <a class="nav-link active" target="_blank" href="<?php echo base_url(); ?>admin/pdf">
                                        <div class="sb-nav-link-icon"><i class="fas fa-file-download fa-lg"></i></div>
                                        Prestamos
                                    </a>
                                </h5>
                            </nav>
                        </div>
                    <!--End Reportes-->
                        </div>
                </div>
                <div class="sb-sidenav-footer bg-primary text-center">
                        <img src="<?php echo base_url(); ?>Assets/img/muni.png" alt="mdm" width="100"/>
                </div>
            </nav>
        </div>