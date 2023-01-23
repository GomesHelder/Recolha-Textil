<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/hover.css">
    <link rel="stylesheet" href="style/style_bar.css">    
    <link rel="stylesheet" href="style/style_info.css">
    <script src="https://kit.fontawesome.com/814cef7203.js" crossorigin="anonymous"></script>
    <title>Criar Ecoponto</title>
    <script>
        function voltar() {
            history.go(-1);
            return false;
        }
    </script>
</head>
<body>
    <!-- Menu de navegação -->
    <ul>
        <li><a href="index.html"><i class="fa-solid fa-house"></i></a></li>
    </ul>
    <?php
    // Estabelece ligação à base de dados
    require("utilizador/auth_empresa.php");
    // Verifica se foi submetido o formulário principal
    if(isset($_POST["submit"])){
        // Atribui à variável o email do utilizador que está logado
        $email = $_SESSION["email"];
        // Vai à base de dados buscar o id da Empresa
        $sql = "select id from `empresa_ecopontos` where email='$email'";
        $resultsql = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($resultsql, MYSQLI_ASSOC);
        // Insere o id da Empresa na variável $id_empresa
        $id_empresa = $row['id'];
        // Insere na base de dados os dados do novo ecoponto
        $inserir = "INSERT INTO ecopontos (id_empresa, localizacao, latitude, longitude, data_despejo, capacidade_ecoponto, estado_ecoponto) VALUES ('".$id_empresa."', '".$_POST['localizacao']."', '".$_POST['latitude']."', '".$_POST['longitude']."', '".$_POST['data_despejo']."', '".$_POST['capacidade']."', '".$_POST['estado']."')";
        $resultinserir = mysqli_query($conn, $inserir);
        echo "Ecoponto criado com sucesso";
        echo "<br>Clique <a href='ecopontos.php'>aqui</a> para voltar!<br>";
    // Não veio da submissão do formulário inicial
    }else{
    ?>
        <form method="post" enctype="multipart/form-data">
            <label for="localizacao">Localização do ecoponto (Exemplo: Viana do Castelo)</label>
            <input type="text" name="localizacao" required/>


            <h3>Coordenadas do Ecoponto</h3>

            <div class="show">Precisa de ajuda a encontrar as coordenas?</div>
            <div class="hide">
            Obtenha as coordenadas de um local<br>
            1- No computador, abra o Google Maps. <br>
            2- Clique com o botão direito do rato no local ou na área do mapa.<br>
            Esta ação abre uma janela de pop-up. Pode encontrar a latitude e a longitude em formato decimal na parte superior.<br>
            3- Para copiar as coordenadas automaticamente, clique com o botão esquerdo do rato na latitude e na longitude.
            </div><br>

            <label for="latitude">Latitude</label>
            <input type="text" name="latitude" required/><br>

            <label for="longitude">Longitude</label>
            <input type="text" name="longitude" required/><br>

            <label for="data_despejo">Data do próximo despejo do ecoponto</label>
            <input type="text" name="data_despejo" required/><br>

            <label for="capacidade">Capacidade do ecoponto</label>
            <input type="text" name="capacidade" required/><br>

            <label for="estado">Estado do ecoponto</label>
            <input type="text" name="estado" required/><br>

            <input type="submit" name="submit" value="Enviar">
            <br>
            Clique <a href="" onclick="return voltar()">aqui</a> para voltar!<br>
        </form>
    <?php
    }
    ?>
    <br>
</body>
</html>