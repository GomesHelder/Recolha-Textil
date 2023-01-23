<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style3.css">
    <link rel="stylesheet" href="style/style_bar.css">
    <script src="https://kit.fontawesome.com/814cef7203.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,600;1,200;1,400;1,600&display=swap" rel="stylesheet"/>
    <title>Histórico de Despejos</title>
</head>
<body>
    <!-- Menu de navegação -->
    <ul>
        <li><a href="index.html"><i class="fa-solid fa-house"></i></a></li>
    </ul>
    <?php
    // Estabelece ligação à base de dados
    include("utilizador/auth_municipe.php");
    // Atribui à variável o email do utilizador que está logado
    $email = $_SESSION['email'];
    // Vai à base de dados buscar os dados do munícipe logado
    $sqlnome = "select * from `municipe` where email='$email'";
    $resultnome = mysqli_query($conn, $sqlnome);
    $rown = mysqli_fetch_array($resultnome, MYSQLI_ASSOC);
    // Atribui à variável $id_municipe o id do munícipe logado
    $id_municipe = $rown['id'];
    // Vai à base de dados buscar os dados dos produtos depositados por um certo municípe
    $sql = "select produto.id, produto.id_municipe, produto.nome_produto, produto.diretorio_img, despejos.data_despejo from `produto` INNER JOIN despejos on produto.id = despejos.id_produto WHERE id_municipe='$id_municipe'";
    $result = mysqli_query($conn, $sql);

    //$row = mysqli_fetch_assoc($conn, $result);
    print_r($row1);
    ?>
    <h1>HISTÓRICO DE DEPÓSITOS</h1>
        <?php 
        // Percorre os dados todos e escreve em cartões os vários produtos e as suas informações
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {?>
                <div class="card">
                    <img src="<?php echo $row['diretorio_img']; ?>" alt="Imagem_Produto" style="width:100%">
                    <div class="container">
                        <h4><b> <?php echo $row['nome_produto']; ?> </b></h4>
                        <p> <?php echo $row['data_despejo']; ?> </p>          
                    </div>
                </div><?php
            }
        } else {
            echo "Não foram encontrados produtos";
        }
    ?>
</body>
</html>