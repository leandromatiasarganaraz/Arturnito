<?php

session_start();

// ------------- Verificar datos de usuario -------------

if ($_POST) {
  require_once('funciones.php');

  // Que los campos no esten vacios

  $error = validar_campos_vacios_login($_POST);

  // Si no hay error

  if (!$error) {

    // Verificar que exista el usuarios

    $usuario = verificarUsuario($_POST);
    if (!$usuario) {
      $noExiste = 'El usuario no existe o la contraseña es incorrecta';
      $noExiste1 = '';
    }

    // Si existe en $_SESSION, redirigir
    if ($usuario->estado == 1) {
      $_SESSION['usuario'] = $usuario;
      if ($usuario->rol == 'Usuario') {
        header('location:vistas/atencion/atencion.php');
      } elseif ($usuario->rol == 'Administrador') {
        header('location:vistas/usuarios/usuarios.php');
      }
    }
  }
}
if (!isset($_SESSION['usuario'])) {
?>
  <!doctype html>
  <html>

  <head>
    <link rel="shortcut icon" href="#" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Arturnito</title>

    <link rel="stylesheet" href="global/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" type="text/css" href="global/fuentes/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="global/dist/css/alertify.css">

    <!-- jquery -->
    <script src="global/dist/js/jquery-3.5.1.min.js"></script>
    <script src="global/dist/js/alertify.js"></script>

  </head>

  <body>

    <div class="container-login">
      <div class="wrap-login">
        <div style="color: #e03232; background-color: color: #f8d7da;">
          <?= $noExiste ?? '' ?><?= $noExiste1 ?? '' ?>
        </div>
        <form class="login-form validate-form" id="formLogin" action="index.php" method="post">


          <img class="imglogo" src="global/dist/img/arturnito.ico" alt="Logo">

          <p class="login-form-title">ARTURNITO</p>


          <div class="wrap-input100" data-validate="Usuario incorrecto">
            <input class="input100" type="text" id="usuario" name="usuario" placeholder="Usuario">
            <span class="focus-efecto"></span>
          </div>
          <div class="col-12 mb-2" style="color: #e03232; background-color: color: #f8d7da;">
            <?= $error['usuario'] ?? '' ?>
          </div>
          <div class="wrap-input100" data-validate="Password incorrecto">
            <input class="input100" type="password" id="password" name="password" placeholder="Contraseña">
            <span class="focus-efecto"></span>
          </div>
          <div class="col-12 mb-2" style="color: #e03232; background-color: color: #f8d7da;">
            <?= $error['password'] ?? '' ?>
          </div>
          <div class="container-login-form-btn">
            <div class="wrap-login-form-btn">
              <div class="login-form-bgbtn"></div>
              <button type="submit" id="submit" name="submit" class="login-form-btn">INICIAR SESION</button>
            </div>
          </div>
        </form>
      </div>
    </div>

  </body>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#submit').click(function() {

        if ($.trim($('#usuario').val()) == "") {
          alertify.alert("Debes completar el campo usuario.");
          return false;
        } else if ($('#password').val() == "") {
          alertify.alert("Debes ingresar una Contraseña para continuar.");
          return false;
        }



      });
    });
  </script>

  </html>
<?php
} else {
  if ($_SESSION['usuario']->rol == '2') {
    header('location:vistas/atencion/atencion.php');
  } elseif ($_SESSION['usuario']->rol == '1') {
    header('location:vistas/usuarios/usuarios.php');
  }
}

?>