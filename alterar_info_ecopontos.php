<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style_bar.css">
    <script src="https://kit.fontawesome.com/814cef7203.js" crossorigin="anonymous"></script>
    <title>Alterar Informação do Ecoponto</title>
</head>
<body>
    <!-- Menu de navegação -->
    <ul>
        <li><a href="index.html"><i class="fa-solid fa-house"></i></a></li>
    </ul>
    <?php
    // Estabelece ligação à base de dados
    require("utilizador/liga_BD.php");
    // Atribui a localização do ecoponto à variável $localizacao
    $localizacao = $_POST['localizacao'];
    // Verifica se o campo "data_despejo" veio vazio
    if ($_POST['data_despejo'] != NULL) {
        // Verifica se o campo "estado" veio vazio
        if ($_POST['estado'] == NULL) {
            // Atualiza a "data_despejo" do ecoponto
            $sql1 = "UPDATE `ecopontos` SET `data_despejo` = '".$_POST['data_despejo']."' WHERE `localizacao` = '".$localizacao."';";
            $resultsql1 = mysqli_query($conn, $sql1);
            echo "Data de despejo do ecoponto ".$localizacao." editado com sucesso";
        }else {
            // Atualiza a "data_despejo" e o "estado" do ecoponto
            $sql2 = "UPDATE `ecopontos` SET `data_despejo` = '".$_POST['data_despejo']."', `estado_ecoponto` = '".$_POST['estado']."' WHERE `localizacao` = '".$localizacao."';";
            $resultsql2 = mysqli_query($conn, $sql2);
            echo "Data de despejo e estado do ecoponto ".$localizacao." editados com sucesso";
        }
    // O campo "data_despejo" não veio vazio
    }else {
        // Verifica se o campo "estado" veio vazio
        if ($_POST['estado'] != NULL) {
            // Atualiza o "estado" do ecoponto
            $sql3 = "UPDATE `ecopontos` SET `estado_ecoponto` = '".$_POST['estado']."' WHERE `localizacao` = '".$localizacao."';";
            $resultsql3 = mysqli_query($conn, $sql3);
            echo "Estado do ecoponto ".$localizacao." editado com sucesso";
        }else {
            echo "Não foram inseridos dados nenhuns!";
        }
    }
    ?>
    <br>
    Clique <a href="index.html">aqui</a> para voltar à página inicial!<br>
</body>
</html>