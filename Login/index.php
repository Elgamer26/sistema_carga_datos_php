<?php
//esto es en caso de que no exista la session me llevara al login index
session_start();
if (isset($_SESSION["id_usu"])) {
  header("location: ../Admin/");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet" />

  <link rel="icon" href="../Admin/img/candado.jpg">

  <link rel="stylesheet" href="fonts/icomoon/style.css" />

  <link rel="stylesheet" href="css/owl.carousel.min.css" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />

  <!-- Style -->
  <link rel="stylesheet" href="css/style.css" />

  <title>Login del sistema</title>
</head>

<body style="background-image: url('images/llave2.webp');  
background-repeat: no-repeat;
 background-attachment: fixed;
 background-position: center center;
 background-size: cover;">

  <!-- <div class="content"> -->
  <div class="container">
    <br><br><br>
    <div class="row">

      <div class="col-md-6" style="text-align: center" style="width: 100%; height: 450px">
        <!-- <img src="images/candado.webp" style="border-radius: 50%; width: 100%; height: 450px" alt="Image" class="img-fluid" /> -->
      </div>

      <div class="col-md-6" style="background: #ffbf00eb; border: solid 1px; border-radius: 50px;" style="width: 100%; height: 450px">
        <div class="row justify-content-center">
          <div class="col-md-9" style="width: 100%; height: 450px">

            <h3 style="text-align: center"> <img src="images/logo2.png" style="width: 40%;" alt="Image" class="img-fluid" /></h3>

            <div style="
                    text-align: center;
                    background: #ff000094;
                    padding: 10px;
                    color: white;
                    display: none;
                  " id="none_usu">
              <span><b> Ingrese un usuario para continuar</b></span>
            </div>

            <div style="
                    text-align: center;
                    background: #ff000094;
                    padding: 10px;
                    color: white;
                    display: none;
                  " id="none_pass">
              <span><b> Ingrese un password para continuar</b></span>
            </div>

            <p></p>

            <div class="form-group first">
              <label for="username"><B>USUARIO</B></label>
              <input type="text" class="form-control" id="username" />
            </div>

            <p></p>

            <div class="form-group last mb-4">
              <label for="password"><b>PASSWORD</b></label>
              <input type="password" class="form-control" id="password" />
            </div>

            <div class="alert alert-danger text-center" id="error_logeo" style="color: white; display:none; text-align: center; background: red; border-radius: 15px; padding: 10px;  text-align: center;">
              <span> Usuario o contraseña incorrectos</span>
            </div>

            <div class="row">
              <div class="col-md-5">
                <input type="submit" id="btn_aceptar" value="Ingresar" class="btn btn-block btn-success" />
              </div>

              <div class="col-md-7">
                <a href="recuperar.php" class="btn btn-danger">Se olvido la contraseña?</a>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- </div> -->

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script src="../Admin/js/usuario.js"></script>

  <script src="../Admin/plugins/js/sweetalert2/sweetalert2.all.min.js"></script>
</body>

</html>