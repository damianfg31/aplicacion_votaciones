<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Revalia&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="../../CSS/style_cargar_alumnos.css">
    <title>Cargar Alumnos</title>
</head>
<body>

<?php
session_start();
require_once("../../databases/conection.php");
$nomAdmin = $_SESSION['nomAdmin'];
$usAdmin = $_SESSION['usAdmin'];

$vacio = isset($_POST['variable'])? $_POST['variable']: null;

if(isset($_POST["carrera"])){
    $carreraEst = $_POST["carrera"];
} else{
    $carreraEst = "";
}

if(isset($_POST["numTarjetaId"])){
    $numTarjetaEst = $_POST["numTarjetaId"];
} else{
    $numTarjetaEst = "";
}

if(isset($_POST["nomApEst"])){
    $nombreEst = $_POST["nomApEst"];
} else{
    $nombreEst = "";
}

if(isset($_POST["boton"])) {
    $boton= $_POST["boton"];
    switch($boton){
        case "Guardar":
            $sql="INSERT INTO alumnos (id_alumnos, cedula_alumno, nombre, carrera, cod_candidato, cod_candidatoC, voto) VALUES (NULL, '$numTarjetaEst', '$nombreEst', '$carreraEst', '0', '0', '0')";
            if(empty($carreraEst) || empty($numTarjetaEst) || empty($nombreEst)){
                $vacio = true;
            } else{
                $vacio = false;
                $resultado = mysqli_query($conn,$sql);
                ?>
                    <script>
                        alert("Se registro el estudiante correctamente!");
                    </script>
                <?php
            }
            break;
        case "Cancelar":
            ?>
            <script>
                alert("Su registro de Estudiante se ha Cancelado");
                window.location= "menuadmin.php";
            </script>
            <?php
            break;
    }
}

?>

<header>
<nav class="navbar navbar-default">
    <div class="container-fluid"> 
        <!-- Brand and toggle get grouped for better mobile display -->
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="navbar" id="defaultNavbar1">
            <div class="menu1 col-md-12 col-md-offset-8">
                <ul class="navnavbar-nav">
                    <li class="active">
                    <li><a href="cargar_alumnos.php">Cargar  Alumnos</a></li>
                    <li><a href="cargar_candidatos.php">Cargar Candidatos Personería</a></li>
                    <li><a href="resultados.php">Resultados</a></li>
                    <li><a href="../../index.php">Salir</a></li> 
                </ul>
            </div>
        </div>
        <!-- /.navbar-collapse --> 
    </div>
    <!-- /.container-fluid --> 
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-1">
            <a href="menuadmin.php"><img class="img_aunar" src="../../img/perfil.png" alt="Admin"></a>    
        </div>
        <div class="col-md-1">
            <a href="menuadmin.php"><img class="log_vot" src="../../img/voting-box.png" alt="Votación Representante"></a>
        </div>
        <div class="col-md-5">
            <h1 class="text-center">Sistema de Votaciones 2021</h1>
            <h5 class="text-center">Corporación Universitaria Autónoma de Nariño</h5>
        </div>
        <div class="col-md-2">
            <h6 class="text-right">Bienvenido Administrador:</h6>
            <?php echo $nomAdmin ." " ?>
        </div>
            <div class="col-md-1">
            <a href="#"><img class="usuario_img" src="../../img/profile.png" alt="Usuario"></a>
        </div>
    </div>
</div>
</header>

<div class="container">
    <div class="center-block col-md-7 col-xs-8">
        <h2>Módulo - Registro de Alumnos</h2>
    </div>
    <div class="center-block col-md-6 col-xs-8">
        <h6>Bienvenido <?php  echo " ".$nomAdmin."!"?></h6>
    </div>
    <div class="center-block col-md-10 col-xs-8">
        <form action="cargar_alumnos.php" role="form" method="post">
            <div class="form-group">
                <label for="Carrera">Seleccione el Curso de Estudiante: </label> 
                <select name="carrera" id="carrera">
                    <option value="Primero">Primero</option>
                    <option value="Segundo">Segundo</option>
                    <option value="Tercero">Tercero</option>
                    <option value="Cuarto">Cuarto</option>
                    <option value="Quinto">Quinto</option>
                </select>
            </div>
            <div class="form-group">
                <label for="numTarjetaId">Número de Tarjeta de Identidad: </label>
                <input type="number" name="numTarjetaId" class="form-control" id="numTarjetaId" placeholder="Número Tarjeta Identidad">
            </div>
            <div class="form-group">
                <label for="nomApEst">Nombres y Apellidos: </label>
                <input type="text" name="nomApEst" class="form-control" id="nomApEst" 
                placeholder="Nombre Completo">
            </div>
            <div class="button">
                <input type ="submit" class="btn btn-primary" name="boton" Value="Guardar"> 
                <input type ="submit" class="btn btn-danger" name="boton" Value="Cancelar">  
            </div>
        </form>
    </div>
</div>
<div class="vacioIngreso">
    <?php
        if($vacio){
            echo "<script>
            alert('Algunos campos están vacíos. Por Favor llenar todas las casillas del registro... Gracias.');
            </script>";
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