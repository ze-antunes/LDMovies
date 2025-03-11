<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <?php
        require('baseDados.php');
        session_start();
        if(isset($_POST['username'])){
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];
            if($username == "zetunes" || $username == "ines"){
                $query    = "SELECT * FROM administrador WHERE username = '$username' AND password = '$password';
                        VALUES ('$username', '$password')";
                            $resultados   = pg_query($connection, $query);
            } else {
                $query    = "SELECT * FROM clientes WHERE username = '$username' AND password = '$password';
                        VALUES ('$username', '$password')";
                            $resultados   = pg_query($connection, $query);
            }
            $rows = pg_num_rows($resultados);
            if($rows == 1){
                if($username == "zetunes" || $username == "ines"){
                    $_SESSION['username'] = $username;
                    header("Location: homepageAdmin.php");
                } else {
                    $_SESSION['username'] = $username;
                    header("Location: homepage.php");
                }
            }else{
                echo "<div class='form'>
                <h3>Incorrect Username/password.</h3><br/>
                <p>Click here to <a href='login.php'>Login</a>again.</p></div>";
            }
        }
        else{

        ?>
     
        <div class="login">
            <div class="login-grid">
                <div class="login-container">
                    <h1>LDMovies</h1>
                </div>
                <div class="login-container">
                    <div class="login-container-form">
                        <h3>Bem vindo ao LDMovies</h3>
                        <form method="POST">
                            <input type="text" id="username" name="username" placeholder="Usename" required><br>
                            <input type="password" id="password" name="password" placeholder="Password" required><br>
                            <button type="submit" class="btnLogin" name="login">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php 
        }
    ?>
</body>
</html>