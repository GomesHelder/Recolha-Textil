<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/style_bar.css">
    <link rel="stylesheet" href="../style/style_login.css">
    <script src="https://kit.fontawesome.com/814cef7203.js" crossorigin="anonymous"></script>
    <title>Registo</title>
</head>
<body>
<div class="back">
    <ul>
        <li><a href="../index.html"><i class="fa-solid fa-house"></i></a></li>
    </ul>
    <img src="../imagens/camisolas.png" alt="some text">
    <?php
    require("liga_BD.php");
    if (isset($_REQUEST['email'])) {
        // removes backslashes
        $nome = stripslashes($_REQUEST['nome']);
        //escapes special characters in a string
        $nome = mysqli_real_escape_string($conn, $nome);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($conn, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $apelido    = stripslashes($_REQUEST['apelido']);
        $apelido    = mysqli_real_escape_string($conn, $apelido);
        $sql    = "insert into `municipe` (email, password, nome, apelido)
                     VALUES ('$email', '" . md5($password) . "', '$nome', '$apelido')";
        $result   = mysqli_query($conn, $sql);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='../login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form method="get">
        <h1>REGISTO</h1>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Seu email" required/>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Sua password" required/>
        <br>
        <label for="nome">Primeiro Nome:</label>
        <input type="text" name="nome" id="nome" placeholder="Seu nome" required/>
        <br>
        <label for="apelido">Apelido:</label>
        <input type="text" name="apelido" id="apelido" placeholder="Seu apelido" required/>
        <br>
        <input type="reset" class="submit" value="Apagar Tudo">
        <br>
        <input type="submit" name="submit" value="Registar" class="login-button">
    </form >
    <p id="log">Já tem conta? Faça <a href="login.php"> login</a></p>
</div>
<?php
    }
?>
</body>
</html>