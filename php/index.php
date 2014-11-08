 <!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title>Felipe Carrillo Puerto || Foro</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="../css/normalize.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/flat-ui.css">
    <link rel="stylesheet" href="../css/iconos.css">
 

    <script src="../js/modernizr-2.6.2.min.js"></script>
    <script src="../js/jquery-1.10.1.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    
</head>
<body>
<div class="container">
    <section class="row">
        <article class="col-md-6">
            <form action="registro.php" method="POST" role="form">
                <div class="login-form">
                    <legend>¿Eres nuevo?, Registrate al foro</legend>
                <div class="form-group ">
                    <input class="form-control" type='text' name='usuario' placeholder="Usuario" required/>
                    <label class="login-field-icon escribir" ></label>
                </div>
                <div class="form-group ">
                    <input class="form-control" type='email' name='email' placeholder="Email" required/>
                    <label class="login-field-icon escribir" ></label>
                </div>
                <div class="form-group ">
                    <input class="form-control" type='password' name='contrasena' placeholder="Contraseña"/>
                    <label class="login-field-icon candado" ></label>
                </div>
               <input class="btn btn-primary" type='submit' value='Registrar' name='enviar'/>
                </div>
            </form> 
        </article>
        <article class="col-md-6">
            <form action="login.php" method="POST" role="form">
                <div class="login-form">
                    <legend>¿Estas registrado?, Ingresa al foro</legend>
                <div class="form-group ">
                    <input class="form-control" type='text' name='usuario' placeholder="Usuario" required/>
                    <label class="login-field-icon escribir" ></label>
                </div>
                <div class="form-group ">
                    <input class="form-control"type='password' name='contrasena' placeholder="Contraseña" required/>
                    <label class="login-field-icon candado" ></label>
                </div>
               <input class="btn btn-primary" type='submit' value='Log in' name='login'/>
                </div>
            </form> 
        </article>
    </section>
</div>
</body>
</html>
