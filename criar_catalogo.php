<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style_bar.css">
    <link rel="stylesheet" href="style/style_table.css">
    <script src="https://kit.fontawesome.com/814cef7203.js" crossorigin="anonymous"></script>
    <title>Criar Catálogos...</title>
</head>
<body>
    <!-- Menu de navegação -->
    <ul>
        <li><a href="index.html"><i class="fa-solid fa-house"></i></a></li>
        <li><a href="utilizador/login_empresa.php">Empresas</a></li>
        <li style="float:right"><a href="utilizador/login.php"><i class="fa-solid fa-user"></i></a></li>
    </ul>
    <?php
    // Estabelece ligação à base de dados
    require("utilizador/liga_BD.php");
    // Inicia sessão e verifica se tem sessão iniciada
    session_start();
    // Atribui à variável a data do sistema
    $data = date('d/m/y');
    // Verifica se foi submetido o formulário principal
    if(isset($_POST["submit"])){
        // Atribui à variável a localização do ecoponto
        $id_ecoponto = $_POST["localizacao"];
        ?>
        <form action="registar_catalogo.php" method="post">
            <label for="produto">Escolha o produto:</label><br>
            <select name="produto" id="produto">
                <?php
                    // Vai buscar à base de dados os dados do produto e a data de despejo do produto
                    $sql1 = "select produto.id, produto.id_municipe, produto.nome_produto, produto.diretorio_img, despejos.data_despejo from `produto` INNER JOIN despejos on produto.id = despejos.id_produto where despejos.id_ecoponto= '$id_ecoponto'";
                    $result1 = mysqli_query($conn, $sql1);
                    // Percorre os dados e vai escrevendo no dropdown opções com os vários dados dos produtos
                    while ($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)){?>
                        <option value="<?php echo $row["id"];?>">
                            <?php echo "ID: ". $row["id"]. ", Nome: " .$row["nome_produto"]. ", Despejo: " .$row["data_despejo"];?>
                        </option>
                    <?php
                    }
                ?>
            </select><br>
            
            <select name="tipo">
                <option value="residuo">Resíduo</option>
                <option value="venda">Venda</option>
            </select><br>
   
            <input type="text" name="empresa_compra" id="empresa_compra">
                
            <input type="hidden" name="data_despejo_ecoponto" value="<?php echo $data; ?>">
            <input type="hidden" name="id_ecoponto" value="<?php echo $id_ecoponto; ?>">

            <input type="submit" name="submit" value="Enviar">
        </form>
    <?php
    }else{
        ?>
        <form action="" method="post">
            <label>Indique o ecoponto</label><br>
            <select name="localizacao" id="localizacao">
                <?php
                    // Vai buscar à base de dados o id e a localização do ecoponto
                    $localizacao = "select id, localizacao from `ecopontos`";
                    $resultloc = mysqli_query($conn, $localizacao);
                    // Percorre os dados e vai escrevendo no dropdown opções com as várias localizações dos ecopontos
                    while ($rowloc = mysqli_fetch_array($resultloc,MYSQLI_ASSOC)){?>
                        <option value="<?php echo $rowloc["id"];?>">
                            <?php echo $rowloc["localizacao"];?>
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