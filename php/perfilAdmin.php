<?php
include("session.php");

        require('baseDados.php');
        if(isset($_POST['montante'])){
            $montante = $_REQUEST['montante'];
            $rows= pg_query("select saldo from clientes where username='". $_SESSION["username"] ."'");
            $saldo = pg_fetch_result($rows, 0, 0);
            $saldo = $saldo + $montante;
            $rows= pg_query("update clientes set saldo='$saldo' where username='". $_SESSION["username"] ."'");
        }
?>

    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class="perfil">
        <div class="horizontal_bar">

            <!-- Menu -->
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="homepageAdmin.php">Home</a>
                <a href="perfilAdmin.php">Perfil</a>
            </div>

            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
            <a class="logo" href="homepageAdmin.php">LDMovies</a>
            <div class="barra_de_pesquisa">
                <input type="text" name="search" alt="search" class="search">
                <img src="../images/Icons/lupa.png" name="lupa" alt="lupa" class="lupa" width="20px" height="auto">
            </div>
            <img src="../images/Icons/notification.png" alt="notification" class="notification" width="25px" height="auto">

            <!-- TRES PONTINHOS -->
            <div id="myOps" class="optionsnav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeOps()">&times;</a>
                <a href="logout.php">Logout</a>
            </div>
            <span style="font-size:30px;cursor:pointer" onclick="openOps()">
                <img src="../images/Icons/options.png" alt="options" class="options" width="22px" height="auto">
            </span>

            <img src="../images/cover.png" alt="cover" class="cover" width="100%" height="auto">

        </div>

            <img src="../images/Icons/perfil.png" alt="perfil" class="perfil-image" width="50px" height="auto">
            <h2 class="perfil-BemVindo">Bem Vindo <?php echo $_SESSION["username"] ?></h2>

    <script type="text/javascript" src="../JS/menuAdmin.js"></script>

    <!-- POPUPs SCRIPT -->

    <script>
        function openCarregar() {
            document.getElementById("CarregarSaldoForm").style.display = "block";
        }

        function closeCarregar() {
            document.getElementById("CarregarSaldoForm").style.display = "none";
        }

        function openTransferencia() {
            document.getElementById("TransferenciaForm").style.display = "block";
        }

        function closeTransferencia() {
            document.getElementById("TransferenciaForm").style.display = "none";
        }
    </script>

<br><br><br><br><br><br>
</body>
</html>