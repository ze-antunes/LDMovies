<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="../css/main.css"/>
</head>
<body>
<?php
    require('baseDados.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'], $_REQUEST['password'])) {
        $username = ($_REQUEST['username']);
        $password = ($_REQUEST['password']);
        $query    = "INSERT into clientes (username, password)
            VALUES ('$username', '$password')";
        $resultados   = pg_query($connection, $query);  

        if ($resultados) {
            echo "<div class='form'>
                <h3>You are registered successfully.</h3><br/>
                <p class='link'>Click here to <a href='login.php'>Login</a></p>
                </div>";
        } else {
            echo "<div class='form'>
                <h3>Required fields are missing.</h3><br/>
                <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                </div>";
        }
    } else {
?>
        <div class="login">
                <div class="login-grid">
                    <div class="login-container">
                        <h1>LDMovies</h1>
                    </div>
                    <div class="login-container">
                    <div class="login-container-form">
                    <form  class="form" method="POST">
                        <h3 class="login-title">Registration</h3>
                        <input type="text" id="username" name="username" placeholder="Usename" required><br>
                        <input type="password" id="password" name="password" placeholder="Password"><br>
                        <button formaction="registration.php" class="btnRegister" name="register">Register</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
    exit();
?>
</body>
</html>