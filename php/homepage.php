<?php
include("session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="css/index.css"> -->
    <!-- <link rel="stylesheet" href="css/homepage.css"> -->
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class="homepage">
        <div class="horizontal_bar">

            <!-- Menu -->
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="homepage.php">Home</a>
                <a href="perfil.php">Perfil</a>
            </div>

              <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
            <a class="logo" href="/homepage.php">LDMovies</a>
            <div class="barra_de_pesquisa">
            <form name="searching">
                <input type="text" name="search" alt="search" class="search">
                <img type="submit" src="../images/Icons/lupa.png" name="lupa" alt="lupa" class="lupa" width="20px" height="auto">
            </form>
            </div>
            <img src="../images/Icons/notification.png" alt="notification" class="notification" width="25px" height="auto">
            
            <?php
                require('baseDados.php');
                if(isset($_GET['search'])) {
                    $search = $_GET['search'];
                    $query = "SELECT * FROM filmes";
                    $resultados = pg_query($connection, $query);
                    $numFilmes = pg_num_rows($resultados);

                    
                    for($i = 0; $i < $numFilmes; $i++){ //vai ver todos os filmes
                        $resultados= pg_query($connection,"select * from filmes where id='". $i ."'");
                        $filmeColumn = pg_fetch_row($resultados);
                            if($filmeColumn[0] == $search || $filmeColumn[2] == $search || $filmeColumn[3] == $search || $filmeColumn[4] == $search){
                                echo '<div class="card">
                                    <div class="card-information">
                                    <img src="../images/' . $i .'.jpg" alt="1" style="width:200px" onclick="filme(' . $i . ')" value="' . $i . '">
                                    <h3>' . $filmeColumn[0] . '</h3>
                                    </div>
                                </div>';
                        }
                    }
            }
            ?>
            
            
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

        <div>
            <h2 class="homepage-títuloFilmes">Filmes</h2>
                <span style="font-size:30px;cursor:pointer" onclick="openOrdem()">
                    <img src="../images/Icons/list.png" alt="list" class="homepage-list" width="22px" height="auto">
                </span>
        </div>

        <div class="homepage-grid">

        <?php
                    require('baseDados.php');
                    $query = "SELECT * FROM filmes";
                    $resultados = pg_query($connection, $query);
                    $numFilmes = pg_num_rows($resultados);

                    $sinopse = array(
                        0 => 'Os caminhos de vários criminosos se cruzam nestas três histórias de Quentin Tarantino. Um pistoleiro se apaixona pela mulher de seu chefe, um boxeador não se sai bem em uma luta e um casal tenta executar um plano de roubo que foge do controle.',
                        1 => 'A ex-assassina conhecida apenas como "A Noiva" acorda de um coma de quatro anos decidida a se vingar de Bill, seu ex-amante e chefe, que tentou matá-la no dia do casamento. Ela está motivada a acertar as contas com cada uma das pessoas envolvidas com a perda da filha, da festa de casamento e dos quatro anos da sua vida. Na jornada, "A Noiva" é submetida a dores físicas agoniantes ao enfrentar a inescrupulosa gangue de Bill, o Esquadrão Assassino de Víboras Mortais.', 
                        2 => 'Dom Cobb é um ladrão com a rara habilidade de roubar segredos do inconsciente, obtidos durante o estado de sono. Impedido de retornar para sua família, ele recebe a oportunidade de se redimir ao realizar uma tarefa aparentemente impossível: plantar uma ideia na mente do herdeiro de um império. Para realizar o crime perfeito, ele conta com a ajuda do parceiro Arthur, o discreto Eames e a arquiteta de sonhos Ariadne. Juntos, eles correm para que o inimigo não antecipe seus passos.', 
                        3 => 'Um alerta vermelho da Interpol é emitido e o agente do FBI John Hartley assume o caso. Durante sua busca, ele se vê diante de um assalto ousado e é forçado a se aliar ao maior ladrão de arte da história, Nolan Booth, para capturar a ladra de arte mais procurada do mundo atualmente, Sarah Black.',
                        4 => 'O relacionamento entre Eddie e Venom está evoluindo. Buscando a melhor forma de lidar com a inevitável simbiose, esse dois lados descobrem como viver juntos e, de alguma forma, se tornarem melhores juntos do que separados.', 
                        5 => 'No final da década de 1960, Hollywood começa a se transformar e o astro de TV Rick Dalton e seu dublê Cliff Booth tentam acompanhar as mudanças.',
                        6 => 'Durante a Segunda Guerra Mundial, na França, um grupo de judeus americanos conhecidos como Bastardos espalha o terror entre o terceiro Reich. Ao mesmo tempo, Shosanna, uma judia que fugiu dos nazistas, planeja vingança quando um evento em seu cinema reunirá os líderes do partido.', 
                        7 => 'Paul Atreides é um jovem brilhante, dono de um destino além de sua compreensão. Ele deve viajar para o planeta mais perigoso do universo para garantir o futuro de seu povo.',
                        8 => 'Os caminhos de vários criminosos se cruzam nestas três histórias de Quentin Tarantino. Um pistoleiro se apaixona pela mulher de seu chefe, um boxeador não se sai bem em uma luta e um casal tenta executar um plano de roubo que foge do controle.',
                        9 => 'A ex-assassina conhecida apenas como "A Noiva" acorda de um coma de quatro anos decidida a se vingar de Bill, seu ex-amante e chefe, que tentou matá-la no dia do casamento. Ela está motivada a acertar as contas com cada uma das pessoas envolvidas com a perda da filha, da festa de casamento e dos quatro anos da sua vida. Na jornada, "A Noiva" é submetida a dores físicas agoniantes ao enfrentar a inescrupulosa gangue de Bill, o Esquadrão Assassino de Víboras Mortais.', 
                        10 => 'Dom Cobb é um ladrão com a rara habilidade de roubar segredos do inconsciente, obtidos durante o estado de sono. Impedido de retornar para sua família, ele recebe a oportunidade de se redimir ao realizar uma tarefa aparentemente impossível: plantar uma ideia na mente do herdeiro de um império. Para realizar o crime perfeito, ele conta com a ajuda do parceiro Arthur, o discreto Eames e a arquiteta de sonhos Ariadne. Juntos, eles correm para que o inimigo não antecipe seus passos.', 
                        11 => 'Um alerta vermelho da Interpol é emitido e o agente do FBI John Hartley assume o caso. Durante sua busca, ele se vê diante de um assalto ousado e é forçado a se aliar ao maior ladrão de arte da história, Nolan Booth, para capturar a ladra de arte mais procurada do mundo atualmente, Sarah Black.',
                        12 => 'O relacionamento entre Eddie e Venom está evoluindo. Buscando a melhor forma de lidar com a inevitável simbiose, esse dois lados descobrem como viver juntos e, de alguma forma, se tornarem melhores juntos do que separados.', 
                        13 => 'No final da década de 1960, Hollywood começa a se transformar e o astro de TV Rick Dalton e seu dublê Cliff Booth tentam acompanhar as mudanças.',
                        14 => 'Durante a Segunda Guerra Mundial, na França, um grupo de judeus americanos conhecidos como Bastardos espalha o terror entre o terceiro Reich. Ao mesmo tempo, Shosanna, uma judia que fugiu dos nazistas, planeja vingança quando um evento em seu cinema reunirá os líderes do partido.', 
                        15 => 'Paul Atreides é um jovem brilhante, dono de um destino além de sua compreensão. Ele deve viajar para o planeta mais perigoso do universo para garantir o futuro de seu povo.',
                    );


                    for($i = 0; $i < $numFilmes; $i++){
                        $rows= pg_query("select * from filmes where id='". $i ."'");
                        $filme = pg_fetch_row($rows);
    
                        echo 
                        '<div class="homepage-grid-container">
                            <div class="card">
                                <div class="card-information">
                                <img src="../images/' . $i .'.jpg" alt="1" style="width:200px" onclick="filme(' . $i . ')" value="' . $i . '">
                                <h3>' . $filme[0] . '</h3>
                                <h4>' . $filme[1] . '</h4> 
                                <h5>' . $sinopse[$i] . '</h5>
                                </div>
                            </div>
                        </div>';
                    }

                    /* ORDEM POR TITULO */
                    $OrdemTituloquery = "SELECT titulo FROM filmes";
                    $resultados = pg_query($connection, $OrdemTituloquery);
                    $todosTitulos = pg_fetch_all($resultados);
                    sort($todosTitulos);

                    /* echo 'titulos: ' . json_encode($todosTitulos);

                    echo '<br>';echo '<br>';echo '<br>'; */

                    /* ORDEM POR ANO */
                
                    $OrdemAnosquery = "SELECT ano FROM filmes";
                    $resultados = pg_query($connection, $OrdemAnosquery);
                    $todosAnos = pg_fetch_all($resultados);
                    sort($todosAnos);
                    
                    /* echo 'anos: ' . json_encode($todosAnos); */
                ?>
        </div>
    </div>

    <!-- Ordem filmes -->

    <div class="form-popup" id="OrdemForm">
        <form action="homepage.php" method="POST" class="form-container">
            <h2>Ordenar por:</h2>

            <input type="button" class="btnForm" name="tituloOrdem" value="Título">
            <input type="button" class="btnForm" name="anoOrdem" value="Ano">

            <button type="button" class="btnForm cancel" onclick="closeOrdem()">Cancelar</button>
        </form>
    </div>

    <script type="text/javascript" src="../JS/menu.js"></script>

    <!-- POPUPs SCRIPT -->
    
    <script>
        function openOrdem() {
            document.getElementById("OrdemForm").style.display = "block";
        }

        function closeOrdem() {
            document.getElementById("OrdemForm").style.display = "none";
        }
    </script>
</body>
</html>