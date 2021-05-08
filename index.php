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
    <!-- Linkear las fuentes --> 
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel = "stylesheet" href= "./CSS/style_i.css">   
    <title>Sistema de Votaciones 2021</title>
</head>
<body>

<?php
//Lenguaje de Programación
// -variables -> $ -> deben empezar con una letra. No utilizar números al inicio
// CICLOS -> FOR, WHILE , DO WHILE
// $codigo; //declarar
// $cod = 0; //asignación

session_start(); //inicio una sesion de un valor
require_once("databases/conection.php"); //Incrustar o vincular un archivo PHP
$acceso = isset($_POST['variable'])? $_POST['variable']:null;

if(isset($_POST["tialumno"])){
    $estudiante = $_POST["tialumno"];
}
#Comentario
//Comentario
/*Comentario*/ 
if(isset($_POST["boton"])){
    $boton = $_POST["boton"];
    
    switch($boton){
        case "Ingresar";
            if(empty($estudiante)){
                $vacio = "si";  // declaro variable y asigno la palabra 'si'
                break;
            }
        $sql = "SELECT * FROM `alumnos` WHERE cedula_alumno = $estudiante";
        $resultado = mysqli_query($conn,$sql); //el no guarda un dato sino un objeto de datos
        $datos = mysqli_fetch_array($resultado); // array de un solo registro -> datos['nombre','carrera', 0, 1]
        $cedAlumno = $datos['cedula_alumno'];
        $nomAlumno = $datos['nombre'];
        $votoAlumno = $datos['voto'];
        //$carreraAlumno = $datos['carrera']

        if($estudiante == $cedAlumno){
            $_SESSION["nombreEst"] = $nomAlumno;
            $_SESSION["curso"] = $datos['carrera'];
            $_SESSION["cedulaAlumno"] = $cedAlumno;

            if($votoAlumno == 0){
                echo "<script>
                    window.location = 'pages/menu_estudiante.php' 
                </script>";
            } else {
                $acceso = "yavoto";
            }

        } else{
            $acceso = "denegado";
        }
        break;
        case "Cancelar";
        ?>
            <script>
                alert("Si quiere cancelar su ingreso, cierre la pestaña... Gracias.");
            </script>
            <?php
        break;
    }
}

?>

<header>
        
        <div class="container">
            <img class="img_aunar" src="./img/school.png" alt="AUNAR">
            <div class="titulopagina">
                <h1>SISTEMA DE VOTACIONES</h1>
                <h3>2021</h3>
            </div>
            <img class="log_vot" src="./img/voting-box.png" alt="Votación Representante">
        </div> 
</header>

<section>
<div class="container">
<form action="index.php" role="form" method="post"> <!--los datos que se resivan va al index.php-->
<label for="tialumno">Escribe tu Número de Tarjeta de Identidad:</label>
  <div class="form-group">
        <h6>Número: </h6>
        <input type="number" name="tialumno" class="form-control" id="alumno" placeholder="alúmno">
  </div>
    <div class ="button-group">
        <input type ="submit" class="btn btn-primary" name="boton" value="Ingresar" >
        <input type ="submit" class="btn btn-danger" name="boton" value="Cancelar" >
   </div>
</form>
<div align="center">
    <?php
        if($acceso == "denegado"){
            echo "<h1>El Número: " .$estudiante. " no se encuentra en el sistema</h1>";
        } 
        if($acceso == "yavoto"){
            echo "<h1>Este estudiante ya relizó su voto. Gracias</h1>";
        }
    ?>
</div>
</section>
<footer>
    <div class="creditos">
        Creditos: Damian Felipe Villarreal Gavilanes <br>
        damianfg31@gmail.com 
    </div>
</footer>
</body>
</html>