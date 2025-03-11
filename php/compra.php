<?php
include("session.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Compra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="css/index.css"> -->
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
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

        </div>

        <div class="container">
            <?php
                $i = $_GET['i'];
                echo '<img src="../images/Filmes/' . $i . '.jpg" alt="PF_cover" width="150px" height="auto">
                <div class="container-information">';
                
                require('baseDados.php');
                $rows= pg_query("select * from filmes where id='". $i . "'");
                $filme = pg_fetch_row($rows);
                if($filme[6]!= NULL || $filme[6]!=0){
                $preço = $filme[5] - (($filme[6] * $filme[5]) / 100) ;
                }
                else{
                    $preço = $filme[5];
                }
                echo '<h2>' . $filme[0] . '</h2> 
                <h4>TOTAL</h4> 
                <h3><b>' . $preço . '€</b></h3>
            </div>
        </div>
        <div class="container">
            <h2>Dados</h2>
            <div class="purchaseForm">
                <form name="purchaseForm">
                    <label for="Endereço">Endereço:</label><br>
                    <input type="text" class="Endereço" name="Endereço"><br>
                    <label for="Cartão">Cartão de crédito ou débito:</label><br>
                    <input type="text" class="Cartão" name="Cartão"><br>
                    <label for="VCV">VCV:</label><br>
                    <input type="text" class="VCV" name="VCV"><br>
                    <label for="Data">Data de Vencimento:</label><br>
                    <input type="date" class="Data" name="Data"><br>
                    <label for="PAC">PAC:</label><br>
                    <input type="text" class="PAC" name="PAC"><br>
                    <button type="button" onclick="finalizar(' . $i . ');" value="' . $i . '">Finalizar Compra!</button>
                </form>
            </div>
        </div>';
        ?>    

        <br><br><br><br><br><br>
        <script type="text/javascript" src="../JS/menu.js"></script>
</body>
</html>