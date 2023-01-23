<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..style/style.css">
    <link rel="stylesheet" href="../style/style_bar.css">
    <link rel="stylesheet" href="../style/style_reg.css">
    <script src="https://kit.fontawesome.com/814cef7203.js" crossorigin="anonymous"></script>
    <title>A Terminar Sessão...</title>
</head>
<body>
    <?php
        // Inicia sessão e verifica se tem sessão iniciada
        session_start();
        // Caso tenha sessão iniciada destroi
        if(session_destroy()) {
            echo "<h1>Sessão Terminada! Será redirecionado em 3 segundos</h1>";
            echo "<script>
                setTimeout(function(){
                window.location.href = 'login.php';
                }, 3000);
            </script>";
        }
    ?> 
</body>
</html>
