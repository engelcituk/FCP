<?php
    session_start();
    if(!isset($_SESSION['idioma'])){
        $_SESSION['idioma']="espanol";
    }
    require 'idiomas.php';
    $palabra = new idiomas();
?>
 <!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title>Felipe Carrillo Puerto</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/component.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/iconos.css">
    <link rel="stylesheet" href="css/templatemo_misc.css">
    <link rel="stylesheet" href="css/templatemo_style.css">

    <script src="js/modernizr-2.6.2.min.js"></script>
    <script src="js/jquery-1.10.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    // <script src="js/idiomas.js"></script>
</head>
<body>    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="sidebar-menu">
                    <header class="logo-wrapper">
                        <select class="form-control"id="select_idioma" name="select_idioma" onchange="cambio_idioma()">
                            <option <?php if($_SESSION['idioma']=="espanol") echo "selected='selected'" ?> value="espanol"><?php echo $palabra->idioma[$_SESSION['idioma']][0]; ?></option>
                            <option <?php if($_SESSION['idioma']=="ingles") echo "selected='selected'" ?> value="ingles"><?php echo $palabra->idioma[$_SESSION['idioma']][1]; ?></option>
                        </select>
                       <h1 class="logo"><a rel="nofollow"><img id="logo" class="img-responsive" src="images/logo.png" alt="zona maya"></a></h1>
                    </header> <!-- /.logo-wrapper -->
                    <div class="menu-wrapper">
                        <ul class="menu">
                            <li><a class="homebutton" href="#"><?php echo $palabra->idioma[$_SESSION['idioma']][3]; ?><!-- Inicio --></a></li>
                            <li><a class="show-1" href="#"><?php echo $palabra->idioma[$_SESSION['idioma']][4]; ?><!-- Aventurate --></a></li>
                            <li><a class="show-2" href="#"><?php echo $palabra->idioma[$_SESSION['idioma']][5]; ?><!-- Vivefcp --></a></li>
                            <li><a class="show-3" href="#"><?php echo $palabra->idioma[$_SESSION['idioma']][6]; ?><!-- conoce --></a></li>
                            <li><a class="show-4" href="#"><?php echo $palabra->idioma[$_SESSION['idioma']][7]; ?><!-- foro --></a></li>
                            <li><a class="show-5" href="#">Contacto</a></li>
                        </ul> <!-- /.menu -->
                        <a href="#" class="toggle-menu"><i class="fa fa-bars"></i></a>
                    </div> <!-- /.menu-wrapper -->
                    <!--Arrow Navigation-->
                    <a id="prevslide" class="load-item"><i class="fa fa-angle-left"></i></a>
                    <a id="nextslide" class="load-item"><i class="fa fa-angle-right"></i></a>
                </div> <!-- /.sidebar-menu -->
            </div> <!-- /.col-md-4 -->
            <div class="col-md-8 col-sm-12">
                <div id="menu-container">
                <?php include "aventura.php" ?>
                <?php include "vive.php" ?>
                <?php include "conoce.php" ?>
                
                </div> <!-- /#menu-container -->
            </div> <!-- /.col-md-8 -->
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
    
    
    <script src="js/jquery.easing-1.3.js"></script>
    
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script src="js/galeria.js"></script>
    
</body>
</html>