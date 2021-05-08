<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=7, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Revalia&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="../../CSS/style_menuadmin.css">
    <title>Menu Administrador</title>
</head>
<body>

<?php
session_start();
require_once("../../databases/conection.php");
$nomAdmin = $_SESSION['nomAdmin'];
$usAdmin = $_SESSION['usAdmin'];
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
                    <li><a href="cargar_candidatos.php">Cargar Candidato Personería</a></li>
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
            <h1 class="text-left">Sistema de Votaciones 2021</h1>
            <h5 class="text-left">Corporación Universitaria Autónoma de Nariño</h5>
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
    <div class="center-block col-md-12 col-xs-8">
        <h2>¡Bienvenido Al Módulo de Administración!</h2>
        <img src="../../img/administrador.png" alt="Administrador">
    </div>
    
</div>

<footer>
    Sistema de Votaciones AUNAR &copy; 2021 
    <div class="creditos">
        Créditos: Damian Felipe Villarreal G. <br/>
        damianfg31@gmail.com
    </div>
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous">
</script>
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<!--script src="js/bootstrap.js"></!--script-->

</body>
</html>