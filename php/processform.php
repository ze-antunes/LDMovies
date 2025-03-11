<?php

$errors=0;

$servername= "dbname=postgres user=postgres password=postgres host=localhost port=5432";
$connection = pg_connect($servername);
if (!$connection){
    die("Erro na ligacao");
}

/* MOSTRAR USERS */
/* $resultados= pg_query($connection, "select * from administrador") or die;
$resultados= pg_fetch_all($resultados);
foreach($resultados as $linha){
    print $linha['username'] . " " . $linha['password'];
    print "\n";
}  */

/*  ELIMINAR USER  */

/* $resultados = pg_query($connection, "delete from administrador where username=''");
print pg_affected_rows($resultados);   */

/* ADICIONAR USER */
 /* $resultados = pg_query($connection, "insert into administrador values ('$username' , '$password')");  */

/* echo "Ligacao estabelecida!";    // do something herepg_close($connection); */
pg_close($connection);
?>