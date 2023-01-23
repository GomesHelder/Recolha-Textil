<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style_bar.css">
    <script src="https://kit.fontawesome.com/814cef7203.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <title>Ecopontos</title>
    <style>
        #map{ 
            height: 925px;
        }
   </style>
</head>
<body>
    <!-- Menu de navegação -->
    <ul>
        <li><a href="index.html"><i class="fa-solid fa-house"></i></a></li>
        <li><a href="info_ecopontos.php">Alterar Info Ecopontos</a></li>
        <li><a href="criar_ecoponto.php">Criar Novo Ecoponto</a></li>
        <li style="float:right"><a href="utilizador/login.php"><i class="fa-solid fa-user"></i></a></li>
    </ul>
    <?php
        // Estabelece ligação à base de dados
        require("utilizador/liga_BD.php");
        $sql = "select * from ecopontos";
        $result = mysqli_query($conn, $sql);
        ?>
    <div id="map">
        <script>
            // Criação do mapa
            var map = L.map('map').setView([41.6961, -8.82323], 10);
            var popup = L.popup();
            // Legenda do mapa
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);
        </script>
        <?php
            // Percorre os ecopontos todos e as suas informações
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    // Atribui todos os dados a Variáveis
                    $ecoponto_localizacao = $row['localizacao'];
                    $ecoponto_data_despejo = $row['data_despejo'];
                    $ecoponto_estado = $row['estado_ecoponto'];
                    $ecoponto_latitude = $row['latitude'];
                    $ecoponto_longitude = $row['longitude'];
                    // Mostra no mapa marcadores dependendo da latitude e longitude com os dados dos ecopontos
                    echo "<script>
                    L.marker([".$ecoponto_latitude.", ".$ecoponto_longitude."]).addTo(map)
                    .bindPopup('Contentor de ".$ecoponto_localizacao."<br>Estado: ".$ecoponto_estado."<br>Próximo Despejo: ".$ecoponto_data_despejo."')
                    </script>";
                }
            }
        ?>
    </div>
</body>
</html>