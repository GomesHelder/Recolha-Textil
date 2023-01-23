<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style_info.css">
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
    // Executa o ficheiro de verificacão de autenticação de Empresa
    require("utilizador/auth_empresa.php");
    // Verifica se foi submetido o formulário principal
    if(isset($_POST["submit"])){
        // Atribui a localização do ecoponto à variável $localizacao
        $localizacao = $_POST['localizacao'];
        // Mostra formulário para editar a informação 
        echo "<h2 style='text-align: center;'>A alterar informação do ecoponto: ".$_POST['localizacao']."</h2>";?>
        <form action="alterar_info_ecopontos.php" method="post">
            <label for="data_despejo">Nova data de Despejo do Ecoponto (se deixar em branco não será alterado)</label>
            <input type="text" name="data_despejo" placeholder="Data de Despejo"><br>

            <label for="estado">Defina o estado do Ecoponto (se deixar em branco não será alterado)</label>
            <input type="text" name="estado" placeholder="Estado do Ecoponto">

            <input type="hidden" name="localizacao" value="<?php echo $localizacao;?>">

            <button type="submit">Enviar</button>
        </form><?php
    // Não veio da submissão do formulário inicial
    }else{ 
    ?>
        <!-- Mostra formulário inicial -->
        <form method="post">
            <h3>Escolha o ecoponto ao qual pretende alterar a informação</h3>
            <select name="localizacao" id="localizacao">
                <?php
                    $sql = "select localizacao from `ecopontos`";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){?>
                        <option value="<?php echo $row["localizacao"];?>">
                            <?php echo $row["localizacao"];?>
                        </option>
                    <?php
                    }
                ?>
            </select><br>
            <input type="submit" name="submit" value="Enviar">
        </form>
    <?php 
    } 
    ?>
</body>
</html>
