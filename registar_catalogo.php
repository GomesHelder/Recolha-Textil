<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style/style_reg.css">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Registar...</title>
</head>
<body>
    <!-- Menu de navegação -->
    <ul>
        <li><a href="index.html"><i class="fa-solid fa-house"></i></a></li>
    </ul>
    <?php
    // Estabelece ligação à base de dados
    require("utilizador/liga_BD.php");
    // Inicia sessão e verifica se tem sessão iniciada
    session_start();
    // Atribui à variável a data de despejo do ecoponto
    $data_despejo = $_POST['data_despejo_ecoponto'];
    // Atribui à variável o id do ecoponto
    $id_ecoponto = $_POST['id_ecoponto'];
    // Verifica se o tipo submetido no formulário foi residuo
    if ($_POST["tipo"] == "residuo") {
        // Insere na base de dados o produto como resíduo com os dados para os catálogos
        $inserir1 = "INSERT INTO coletas (id_produto, estado, id_ecoponto, data_coleta) VALUES ('".$_POST["produto"]."', '".$_POST["tipo"]."', '".$id_ecoponto."', '" .$data_despejo."')";
        $result1 = mysqli_query($conn, $inserir1);

        $sql1 = "select id from coletas where id_produto= '".$_POST["produto"]."'";
        $resultsql1 = mysqli_query($conn, $sql1);
        $rowsql1 = mysqli_fetch_array($resultsql1, MYSQLI_ASSOC);
            
        $inserir2 = "INSERT INTO residuos (id_coleta) VALUE ('".$rowsql1['id']."')";
        $result2 = mysqli_query($conn, $inserir2);

        echo "<h3>Resíduo resgistado com sucesso</h3>";
        echo "<br>";
        echo "<h3>Clique <a href='catalogos.php'>aqui</a> para voltar!</h3>";
    // O tipo submetido no formulário foi venda
    }else{
        // Insere na base de dados a venda com os dados para os catálogos
        $inserir1 = "INSERT INTO empresa_compra (id_produto, nome) VALUES ('".$_POST["produto"]."', '".$_POST["empresa_compra"]."')";
        $result1 = mysqli_query($conn, $inserir1);

        $sql1 = "select id from empresa_compra where id_produto ='".$_POST["produto"]."'";
        $resultsql1 = mysqli_query($conn, $sql1);
        $rowsql1 = mysqli_fetch_array($resultsql1,MYSQLI_ASSOC);

        $inserir2 = "INSERT INTO coletas (id_produto, estado, id_ecoponto, data_coleta) VALUES ('".$_POST["produto"]."', '".$_POST["tipo"]."', '".$id_ecoponto."', '" .$data_despejo."')";
        $result2 = mysqli_query($conn, $inserir2);

        $sql2 = "select id from coletas where id_produto ='".$_POST["produto"]."'";
        $resultsql2 = mysqli_query($conn, $sql2);
        $rowsql2 = mysqli_fetch_array($resultsql2,MYSQLI_ASSOC);
            
        $inserir3 = "INSERT INTO venda_produtos (id_empresa_venda, id_coleta, id_produto) VALUES ('".$rowsql1['id']."', '".$rowsql2['id']."', '".$_POST["produto"]."')";
        $result3 = mysqli_query($conn, $inserir3);

        echo "<h3>Venda resgistada com sucesso</h3>";
        echo "<br><br>";
        echo "<h3>Clique <a href='catalogos.php'>aqui</a> para voltar!</h3>";
    }
    ?>
</body>
</html>