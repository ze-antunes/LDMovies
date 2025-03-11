<?php
    //Establece ligação com a base de dados
    $servername= "dbname=postgres user=postgres password=postgres host=localhost port=5432";
    $connection = pg_connect($servername);
    //Verifica conectividade
    if (!$connection){
        die("Erro na ligacao");
    }
?>