<?php
include("session.php");
?>
<script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
</script>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Confirmation</title>
    <link rel="stylesheet" href="../css/main.css"/>
</head>
<body>
<?php
    $i = $_GET['i'];
    require('baseDados.php');
    $rows= pg_query("select * from filmes where id='". $i . "'");
    $filme = pg_fetch_row($rows);
    $addColumn = pg_query("ALTER TABLE clientes ADD COLUMN filme" . $filme[7] . " VARCHAR");
    $insert = pg_query("UPDATE clientes SET filme" . $filme[7] . "='$filme[0]' where username='". $_SESSION["username"] ."'");

    $rows= pg_query("select saldo from clientes where username='". $_SESSION["username"] ."'");
    $saldo = pg_fetch_result($rows, 0, 0);
    if($filme[6]!= NULL || $filme[6]!=0){
        $preço = $filme[5] - (($filme[6] * $filme[5]) / 100) ;
        }
        else{
            $preço = $filme[5];
        }
    $saldo = $saldo - $preço;
    $rows= pg_query("update clientes set saldo='$saldo' where username='". $_SESSION["username"] ."'");
    echo 'Compra efetuada com sucesso!';
    echo "<div>
            <h3>Compra efetuada com sucesso!</h3><br/>
            <p class='link'>Click here to return to <a href='homepageAdmin.php'>Homepage</a></p>
        </div>";
?> 
</body>
</html>