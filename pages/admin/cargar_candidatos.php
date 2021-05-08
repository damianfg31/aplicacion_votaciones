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
    <link rel="stylesheet" href="../../CSS/style_cargar_candidatos.css">
    <title>Cargar Candidatos</title>
</head>
<body>

<?php
session_start();
require_once("../../databases/conection.php");
$nomAdmin = $_SESSION['nomAdmin'];
$usAdmin = $_SESSION['usAdmin'];

$vacio = isset($_POST['variable'])? $_POST['variable']:null;

if(isset($_POST["numTarjetaIdCand"])){
    $numTarjetaCand = $_POST["numTarjetaIdCand"];
} else{  
    $numTarjetaCand = "";
}

if(isset($_POST["nomApCand"])){
    $nombreCand = $_POST["nomApCand"];
} else{
    $nombreCand = "";
}

if(isset($_POST["tipoCandidato"])){
    $tipoCandidato = $_POST["tipoCandidato"];
} else{
    $tipoCandidato = "";
}

if(isset($_POST["boton"])) {
    $boton= $_POST["boton"];
    switch($boton){
        case "Guardar":
            if($tipoCandidato == "Personero"){
                $sql="INSERT INTO candidatos (id_candidato, cedula_candidato, nombre) VALUES (NULL, '$numTarjetaCand', '$nombreCand')";
            }
            if($tipoCandidato == "Contralor") {
                $sql="INSERT INTO candidatosc (id_candidatoC, cedula_candidatoC, nombre) VALUES (NULL, '$numTarjetaCand', '$nombreCand')";
            }
           
            if(empty($numTarjetaCand) || empty($nombreCand) || empty($tipoCandidato)){
                $vacio = true;
            } else{
                $vacio = false;
                $resultado = mysqli_query($conn,$sql);
                ?>
                    <script>
                        alert("Se registro el candidato correctamente!");
                    </script>
                <?php
            }
            break;
        case "Cancelar":
            ?>
            <script>
                alert("Su registro de Candidato se ha Cancelado");
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
    <div class="center-block col-md-8 col-xs-8">
        <h2>Módulo - Registro de Candidatos</h2>
    </div>
    <div class="center-block col-md-6 col-xs-8">
        <h6>Bienvenido <?php  echo " ".$nomAdmin."!"?></h6>
    </div>
    <div class="center-block col-md-10 col-xs-8">
        <form action="cargar_candidatos.php" role="form" method="post">
            <div class="form-group">
                <label for="numTarjetaIdCand">Número de Tarjeta de Identidad: </label>
                <input type="number" name="numTarjetaIdCand" class="form-control" id="numTarjetaIdCand" placeholder="Número Tarjeta Identidad">
            </div>
            <div class="form-group">
                <label for="nomApCand">Nombres y Apellidos: </label>
                <input type="text" name="nomApCand" class="form-control" id="nomApCand" 
                placeholder="Nombre Completo">
            </div>
            <div class="form-group">
                <label for="tipoCandidato">Tipo de Candidato:</label>
                &nbsp Personero
                <input type="radio" name="tipoCandidato" value="Personero" >
                &nbsp Contralor
                <input type="radio" name="tipoCandidato" value="Contralor" >
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