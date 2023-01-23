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
    <title>Login</title>
</head>
<body>
    <div class="back">
        <ul>
            <li><a href="../index.html"><i class="fa-solid fa-house"></i></a></li>
        </ul>
        <img src="../imagens/camisolas.png" alt="camisola">
        <?php 
            // Estabelece ligação à base de dados
            require("liga_BD.php");
            // Verifica se o utilizador já tem sessão iniciada
            include("verificar_login.php");
            // Tentou iniciar sessão
            if (isset($_GET['email'])) {
                $email = $_REQUEST['email'];
                $email = mysqli_real_escape_string($conn, $email);
                $password = $_REQUEST['password'];
                $password = mysqli_real_escape_string($conn, $password);
                // Verifica se a Empresa já existe
                $sql = "select * from `empresa_ecopontos` where email='$email'
                            and password='" . md5($password) . "'";
                $result = mysqli_query($conn, $sql);
                $rows = mysqli_num_rows($result);
                // Dados corretos
                if ($rows == 1) {
                    $_SESSION['email'] = $email;
                    // Redireciona para a página principal
                    header("Location: ../index.html");
                // Dados errados
                } else {
                    ?>
                    <div class='form'>
                    <form class='form' method='get' name='login'>
                    <h1>Login Empresa</h1>
                        <label for='email'>Email:</label>
                        <input type='email' value="<?php echo $email ?>" name='email' id='email' required><br>
                        <label for='password'>Password:</label>
                        <input type='password' placeholder='Digite a sua password' name='password' id='password' required><br>
                        <h3 style="color:red; text-align: center;">Password ou Email Incorretos!</h3>
                        <input type='submit' value='Login' name='submit' class='login-button'/>
                    </form>
                    </div>
                    <p>Se Não For uma Empresa Clique&nbsp;<a href="login.php">Aqui</a> &nbsp;Para Fazer Login</p>";<?php
                }
            // Ainda não tentou iniciar sessão
            } else {
                ?>
                <form class="form" method="get" name="login">
                    <h1>Login Empresa</h1>
                    <label for="email">Email:</label>
                    <input type="email" placeholder="Digite o seu email" name="email" id="email" required><br>
                    <label for="password">Password:</label>
                    <input type="password" placeholder="Digite a sua password" name="password" id="password" required><br>
                    <input type="submit" value="Login" name="submit" class="login-button"/>
                </form>
                <br><br>
                <p>Se Não For uma Empresa Clique&nbsp;<a href="login.php">Aqui</a> &nbsp;Para Fazer Login</p>
            <?php
            }
            ?>
    </div>
</body>
</html>