<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style_bar.css">
    <link rel="stylesheet" href="style/style_table.css">
    <script src="https://kit.fontawesome.com/814cef7203.js" crossorigin="anonymous"></script>
    <title>Catálogos</title>
</head>
<body>
    <!-- Menu de navegação -->
    <ul>
        <li><a href="index.html"><i class="fa-solid fa-house"></i></a></li>
        <li><a href="utilizador/login_empresa.php">Empresas</a></li>
        <li style="float:right"><a href="utilizador/login.php"><i class="fa-solid fa-user"></i></a></li>
    </ul>
    <div>
        <?php
        // Estabelece ligação à base de dados
        include("utilizador/auth_empresa.php");
        // Vai à base de dados buscar os dados dos catálogos
        $sql1 = "select ecopontos.localizacao, produto.id, produto.nome_produto, coletas.estado FROM (coletas INNER JOIN produto ON coletas.id_produto = produto.id) INNER JOIN ecopontos ON coletas.id_ecoponto = ecopontos.id ORDER BY ecopontos.localizacao ASC";
        $result1 = mysqli_query($conn, $sql1);
        // Verifica se tem dados na base de dados para os catálogos
        if ($result1->num_rows != 0 ) {?>
            <!-- Tem dados -->
            <table>
            <tr>
                <th>Ecoponto</th>
                <th>Produto</th>
                <th>Estado</th>
                <th>Empresa</th>
            </tr>
            <?php
            // Percorre os dados todos
            while($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                // Procura na base de dados o nome das Empresas de Venda
                $sql2 = "select nome from empresa_compra where id_produto = '".$row1['id']."'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                // Não tem Empresa de Venda
                if ($row2['nome'] == NULL) {
                    // Atribui à variável $nome_empresa "Não Disponível"
                    $nome_empresa = "Não Disponível";
                }else {
                    // Atribui à variável $nome_empresa o nome da Empresa de vendas
                    $nome_empresa = $row2['nome'];
                }
                // Vai escrevendo numa tabela os vários registos de catálogos feitos
                ?>
                <tr>
                    <td><?php echo $row1['localizacao'] ?></td>
                    <td><?php echo $row1['nome_produto'] ?></td>
                    <td><?php echo $row1['estado'] ?></td>
                    <td><?php echo $nome_empresa ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
        <?php
        //Não tem dados na base de dados para os catálogos
        }else{
            echo "Não foram encontrados registos!";
        }
        ?>
        <br>
        <a href="criar_catalogo.php">Criar Novo Catálogo</a>

    </div>
</body>
</html>