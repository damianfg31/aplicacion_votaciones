<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Revalia&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../CSS/style_admin.css">
    <title>Administración del Sistema Votaciones</title>
</head>
<body>

<?php
require_once("../../databases/conection.php");
$vacio = isset($_POST['variable'])? $_POST['variable']:null;
$acceso = isset($_POST['variable'])? $_POST['variable']:null;

session_start();


if(isset($_POST['usuario'])){
    $verusuario = $_POST['usuario'];
} else{
    $verusuario = "";
}

if(isset($_POST['clave'])){
    $verclave = $_POST['clave'];
} else{
    $verclave = "";
}

if(isset($_POST['acceder'])){
    if(empty($verusuario) || empty($verclave)){
        $vacio = true;
    }else{
        $sql="SELECT * FROM usuario WHERE usuario='$verusuario' AND clave='$verclave'";
        $resultado = mysqli_query($conn,$sql);
        $datos = mysqli_fetch_array($resultado);
        $BDusuario = $datos['usuario'];
        $BDclave = $datos['clave'];

        if(isset($BDusuario) && isset($BDclave)){
            $acceso = true;
            $_SESSION["nomAdmin"] = $datos['nombre'];
            $_SESSION["usAdmin"] = $BDusuario;
        } else{
            $acceso = false;
        }
    }
}
?>

<header>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-1">
            <img class="img_aunar" src="../../img/perfil.png" alt="Admin">
        </div>
        <div class="col-md-8">
            <h1 class="text-center"> Administrador - Sistema de Votaciones 2021</h1>
            <h5 class="text-center">Corporación Universitaria Autónoma de Nariño - AUNAR Pasto</h5>
        </div>
        <div class="col-md-1">
            <img class="log_vot" src="../../img/voting-box.png" alt="Votación">
        </div>
    </div>
</div>
</header>

<div class="container">
    <div class="center-block col-md-5 col-xs-8">
        <form action="admin.php" role="form" method="post">
            <div class="form-group">
                <label for="Usuario">Usuario: </label>
                <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario">
            </div>
            <div class="form-group">
                <label for="ejemplo_password_1">Contraseña: </label>
                <input type="password" name="clave" class="form-control" id="ejemplo_password_1" 
                placeholder="Contraseña">
            </div>
            <div class="button">
                <input type ="submit" class="btn btn-primary" name="acceder" Value="Ingresar">  
            </div>
        </form>
    </div>
</div>

<div class="accesoadmin">
    <?php
        if($vacio){
            echo "<h6>Los campos están vacíos... Llenar Usuario y Contraseña &nbsp</h6>";
        }
        if($acceso){
            echo "
            <script>
                alert('Bienvenido al administrador!');
                window.location = 'menuadmin.php';
            </script>
            ";
        } else { 
            if(isset($acceso)){
                echo '<h6>&nbsp (Acceso Denegado)</h6>';
            }else{
                echo "";
            }
        }
        
    ?>
</div>

<footer>
    Sistema de Votaciones AUNAR &copy; 2021 
    <div class="creditos">
        Créditos: Damian Felipe Villarreal G. <br/>
        damianfg31@gmail.com
    </div>
</footer>

</body>
</html>