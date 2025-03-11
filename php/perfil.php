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
                <a href="homepage.php">Home</a>
                <a href="perfil.php">Perfil</a>
            </div>

            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
            <a class="logo" href="homepage.php">LDMovies</a>
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
            <h2 class="perfil-BemVindo">Bem Vindo: <?php echo $_SESSION["username"] ?></h2>
            <h3 class="perfil-saldo">Saldo atual:<b>
                    <?php 
                        require('baseDados.php');
                        $rows= pg_query("select saldo from clientes where username='". $_SESSION["username"] ."'");
                        $saldo = pg_fetch_result($rows, 0, 0);
                        echo $saldo;
                    ?>
                €</b>
            </h3>


        <div class="perfil-definiçoes">
        <h3 class="definiçoes">Definições da conta</h3>
            <button class="BtnsGerais" class="carregar" onclick="openCarregar()">Carregar Saldo</button>

            <!-- POPUP CARREGAR -->

            <div class="form-popup" id="CarregarSaldoForm">
                <form action="perfil.php" method="POST" class="form-container">
                    <h2>Montante:</h2>
                    <input type="number" id="montante" name="montante"><br>

                    <button type="submit" class="btnConfirmar btnForm" name="confirmar">Confirmar</button>
                    <button type="button" class="btnForm cancel" onclick="closeCarregar()">Cancelar</button>
                </form>
            </div>
            <?php
            if(isset($_POST['montante'])){
            echo '<p> Carregamento concluído com sucesso! </p>
                <p> Saldo atual: ' . $saldo . '€</p>';
            }
            ?>

            <?php
            require('baseDados.php');
            $rows= pg_query("SELECT username FROM clientes");
            $clientes = pg_fetch_all_columns($rows);
            $lista = pg_num_rows($rows);

            /* POPUP TRANSFERENCIAS */

            echo '
            <button class="BtnsGerais" onclick="openTransferencia()">Efectuar transferência</button>

            <div class="form-popup" id="TransferenciaForm">
                <form action="perfil.php" method="POST" class="form-container">
                    <label for="utilizador">Escolha o utilizador destinatário:</label>
                    <select name="utilizador" id="utilizadores">';
                    for($i=0; $i < $lista; $i++){
                        if($clientes[$i] != $_SESSION["username"]){
                        echo '<option value="' . $clientes[$i] . '">' . $clientes[$i]  . '</option>';
                        }
                    }
                    echo '</select>
                    <br><br>
                    <p>Montante:</p>';
                    $rows= pg_query("select saldo from clientes where username='". $_SESSION["username"] ."'");
                    $saldo = pg_fetch_result($rows, 0, 0);
                    echo '<input type="number" id="montante2" name="montante2"><br>
                    <br><br>
                    <button type="submit" class="btnConfirmar btnForm" name="confirmar">Confirmar</button>
                    <button type="button" class="btnForm cancel" onclick="closeTransferencia()">Cancelar</button>
                </form>
            </div>
                ';
            if(isset($_POST['montante2']) && isset($_POST['utilizador'])){
                if($saldo - $_POST['montante2'] >= 0){
                    $saldo = $saldo - $_POST['montante2'];
                    $rows= pg_query("update clientes set saldo='$saldo' where username='". $_SESSION["username"] ."'");
                    $rows= pg_query("update clientes set saldo='" . $_POST['montante2'] . "' where username='". $_POST["utilizador"] ."'");
                    echo '<p> Transferência efetuada com sucesso! </p>';
                    echo '<p> Saldo atual: ' . $saldo . '€</p>';
                }
                else{
                    echo '<p>Saldo insuficiente!';
                }
            }
            ?>

        </div>
        <div class="perfil-filmes">
            <h3 class="filmes">Meus Filmes</h3>

            <?php
            require('baseDados.php');
            $rows= pg_query("select * from clientes where username='" . $_SESSION['username'] . "'");
            $clientes = pg_fetch_row($rows);
            $numFilmes = pg_num_fields($rows);
            $rows= pg_query("select * from filmes");
            $filmes = pg_fetch_all_columns($rows);
            $totalFilmes = pg_num_fields($rows);
            for($i = 3; $i < $numFilmes; $i++){
                for($j = 0; $j < $totalFilmes; $j++){
                    if($clientes[$i]==$filmes[$j]){
                        echo '<img src="../images/' . $j . '.jpg" width="auto" height="150px">';
                    }
                }
            }
            ?>
        </div>
    </div>
    <script type="text/javascript" src="../JS/menu.js"></script>

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