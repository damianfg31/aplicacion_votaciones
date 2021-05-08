<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Revalia&display=swap" rel="stylesheet">
    <title>Selección de Candidato</title>
    <link rel="stylesheet" href="../CSS/style_menu_estudiante.css">
</head>
<body>
<?php
session_start();
$nomEstudiante = $_SESSION['nombreEst'];
$cursoEstudiante= $_SESSION["curso"];
$cedulaAlumno = $_SESSION["cedulaAlumno"];
require_once("../databases/conection.php");

$vacio = isset($_POST['variable'])? $_POST['variable']: null;
$acceso = isset($_POST['variable'])? $_POST['variable']: null;

/*if(empty($acceso)){
    echo "El dato es vacio";
}
*/
if(isset($_POST["candidato"])){
    $codigofcandidato=$_POST["candidato"];

} else{
    $codigofcandidato = "";
}

if(isset($_POST["candidatoc"])){
    $codigofcandidatoc=$_POST["candidatoc"];

} else{
    $codigofcandidatoc = "";
}

if(isset($_POST["boton"])) {
    $boton= $_POST["boton"];
    switch($boton){
        case "Votar":
            $sql="UPDATE alumnos SET voto='1', cod_candidato='$codigofcandidato', cod_candidatoC='$codigofcandidatoc' WHERE cedula_alumno='$cedulaAlumno'";
            if(empty($codigofcandidato) || empty($codigofcandidatoc)){
                $vacio = true;
            } else{
                $vacio = false;
                $resultado = mysqli_query($conn,$sql);
                ?>
                <script>
                    alert("Gracias por Votar!");
                    window.location= "../index.php";
                </script>
                <?php
            }
            break;
        case "Cancelar":
            ?>
            <script>
                alert("Su voto se ha Cancelado");
                window.location= "../index.php";
            </script>
            <?php
            break;
    }
}

//Condicional ternario
// if condicional SI es es de una sola linea de codigo y una sola condición
// (condicion)? ValorVerdad : ValorFalso
?>
<header>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-1">
            <img class="img_aunar" src="../img/school.png" alt="AUNAR">
        </div>
        <div class="col-md-1">
            <img class="log_vot" src="../img/voting-box.png" alt="Votación Representante">
        </div>
        <div class="col-md-6">
            <h1 class="text-left">Sistema de Votaciones 2021</h1>
            <h5 class="text-left">Corporación Universitaria Autónoma de Nariño</h5>
        </div>
        <div class="col-md-2">
            <h6 class="text-right">Bienvenido Estudiante:</h6>
            <?php echo $nomEstudiante ." " ?>
        </div>
        <div class="col-md-1">
        <a href="#"><img class="usuario_img" src="../img/profile.png" alt="Usuario"></a>
        </div>
    </div>
</div>
</header>

<div class="container">
    <div class="center-block col-md-12 col-xs-8">
    <?php echo "ESTUDIANTE: ".$nomEstudiante. " -- CURSO: ". $cursoEstudiante; ?>
    </div>

    <form name="acceso" action="menu_estudiante.php" role="form" method="POST">
        <div class="md-12">
            <fieldset>
                <legend><em><strong>Selecciona tu Candidato para Personero 2021:</strong></em></legend>
                <?php 
                    $sql = "SELECT * FROM candidatos";
                    $resultado = mysqli_query($conn,$sql);
                    $num_reg = mysqli_num_rows($resultado); //se usa cuando usas select
                ?>
                <table>
                <tr>
                    <?php 
                        for($i=0; $i<$num_reg;$i++){
                            $candidato = mysqli_fetch_array($resultado);
                            $codcandidato = $candidato["id_candidato"];
                            $nomcandidato = $candidato["nombre"];
                    ?>
                    <td width="50px">
                        <img src="../img/img_personeros/<?php echo $codcandidato.".jpg"?>" width="100px" height="120px">
                        <br>
                        <input type="radio" name="candidato" value="<?php echo $codcandidato ?>" >
                        <br>
                        (<?php echo "0".$codcandidato ?>) <?php echo $nomcandidato ?>
                    </td>
                    
                    <?php 
                        }
                    ?>
                </tr>
                </table>
                <br>
            </fieldset>
        </div>
        <div class="md-12">
            <fieldset>
                <legend><em><strong>Selecciona tu Candidato para Contralor 2021:</strong></em></legend>
                <?php 
                    $sql = "SELECT * FROM candidatosc";
                    $resultado = mysqli_query($conn,$sql);
                    $num_reg = mysqli_num_rows($resultado); //se usa cuando usas select
                ?>
                <table>
                <tr>
                    <?php 
                        for($i=0; $i<$num_reg;$i++){
                            $candidatoc = mysqli_fetch_array($resultado);
                            $codcandidatoc = $candidatoc["id_candidatoC"];
                            $nomcandidatoc = $candidatoc["nombre"];
                    ?>
                    <td width="50px">
                        <img src="../img/img_contralores/<?php echo $codcandidatoc.".jpg"?>" width="98px" height="120px">
                        <br>
                        <input type="radio" name="candidatoc" value="<?php echo $codcandidatoc ?>" >
                        <br>
                        (<?php echo "0".$codcandidatoc ?>) <?php echo $nomcandidatoc ?>
                    </td>
                    
                    <?php 
                        }
                    ?>
                </tr>
                </table>
                <br>
            </fieldset>
        </div>
        <div class="botones">
            <input type="submit" class="btn btn-primary" name="boton" value="Votar">
            <input type="submit" class="btn btn-danger" name="boton" value="Cancelar">
        </div>   
    </form>
</div>
<div class="vacioIngreso">
    <?php
        if($vacio){
            echo "<script>
            alert('Algunos campos de votación están vacíos. Por Favor llenar las casillas de votación... Gracias.');
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