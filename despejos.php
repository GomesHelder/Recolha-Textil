<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style2.css">
    <link rel="stylesheet" href="style/style_bar.css">    
    <link rel="stylesheet" href="style/style_desp.css">
    <script src="https://kit.fontawesome.com/814cef7203.js" crossorigin="anonymous"></script>
    <title>Despejos</title>
</head>
<body>
    <!-- Menu de navegação -->
    <ul>
        <li><a href="index.html"><i class="fa-solid fa-house"></i></a></li>
        <li><a href="utilizador/login_empresa.php">Empresas</a></li>
        <li style="float:right"><a href="utilizador/login.php"><i class="fa-solid fa-user"></i></a></li>
    </ul>
    <?php
    // Executa o ficheiro de verificacão de autenticação de municípe
    include("utilizador/auth_municipe.php");
    // Estabelece ligação à base de dados
    require("utilizador/liga_BD.php");
    // Desliga os erros do php
    error_reporting(0);
    $check = 0;
    // Atribui à variável a data do sistema
    $data = date('d/m/y');
    // Verifica se foi submetido o formulário principal
    if(isset($_POST["submit"])){
        // Atribui à variável o email do utilizador que está logado
        $email = $_SESSION['email'];
        $msg_status = '';
        // Atribui à variável a pasta onde serão guardadas as imagens
        $diretorio = "imagens/";
        // Atribui à variável o nome que vem da imagem
        $nome_ficheiro = basename($_FILES["file"]["name"]);
        // Atribui à variável o caminho final da imagem
        $ficheiro_diretorio = $diretorio . $nome_ficheiro;
        // Atribui à variável a extensão da imagem
        $fileType = pathinfo($ficheiro_diretorio,PATHINFO_EXTENSION);
        // Vai buscar à base de dados o id do municípe logado
        $sql = "select id from `municipe` where email='$email'";
        $resultsql = mysqli_query($conn, $sql);
        $rowsql = mysqli_fetch_array($resultsql, MYSQLI_ASSOC);
        // Atribui à variável o id do municípe logado
        $id_municipe = $rowsql['id'];
        // Atribui à variável o tipo de produto que veio do formulário
        $tipo = $_POST['tipo'];
        // Atribui à variável a localização do ecoponto que veio do formulário
        $localizacao = $_POST['localizacao'];
        // Atribui à variável o estado do escoponto que veio do formulário
        $estado = $_POST['estado'];
        // Vai buscar à base de dados o id do ecoponto com base na localização inserida no formulário
        $sql2 = "select id from `ecopontos` where localizacao='$localizacao'";
        $resultsql2 = mysqli_query($conn, $sql2);
        $rowsql2 = mysqli_fetch_array($resultsql2, MYSQLI_ASSOC);
        // Atribui à variável o id do ecoponto
        $id_ecoponto = $rowsql2['id'];
        // Extensões de Ficheiros Permitidos 
        $allowTypes = array('jpg','png','jpeg');
        if(in_array($fileType, $allowTypes)){
            // Mover imagem para a pasta imagens do site
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $ficheiro_diretorio)){
                // Inserir caminho da imagem na base de dados
                $inserir = "INSERT INTO produto (id_municipe, nome_produto, diretorio_img) VALUES ('".$id_municipe."', '".$tipo."', '".$ficheiro_diretorio."')";
                $resultinserir = mysqli_query($conn, $inserir);
                if($resultinserir){
                    $check = 1;
                    $msg_status = "Produto registado com sucesso.";
                }else{
                    $msg_status = "Falha a registar produto, tente de novo.";
                }
            }else{
                $msg_status = "Houve um erro a registar a imagem do seu produto.";
                }
        }else{
            $msg_status = 'Somente são aceites extensões JPG, JPEG & PNG.';
        }
        // Se inseriu com sucesso vai inserir nos despejos a data de despejo
        if($check == 1){
            $sql3 = "select id from `produto` where nome_produto = '$tipo'";
            $resultsql3 = mysqli_query($conn, $sql3);
            $rowsql3 = mysqli_fetch_array($resultsql3, MYSQLI_ASSOC);
            $id_produto = $rowsql3['id'];
            $inserir2 = "INSERT INTO despejos (id_ecoponto, id_produto, data_despejo) VALUES ('".$id_ecoponto."', '".$id_produto."', '".$data."')";
            $resultinserir2 = mysqli_query($conn, $inserir2);
        }else{
            $msg_status = "Falha a registar produto.";
        }

        echo $msg_status;
    // Não foi submetido o formulário principal
    }else{
        ?>
        <table>
            <tr>                
                <td> <h1>DEPÓSITO NOS ECOPONTOS</h1> 
                <p>Depois de depositar as roupas de que já não precisa, 
        está a dar uma de três possibilidades aos seus utensilios têxteis em fim de vida: <br>
        reciclagem, reutilização, ou entrega para ação social.</p>
        <p>Nesta página, poderá colocar os produtos que colocou <br>
        para reciclar e depois poderá ver esses mesmos produtos no Histórico de depositos.<br>
        </td>
        <td></td>
                <td><img width="300" height="150" src='imagens/roupa-estragada-pode-ser-reciclada.jpg'/></td>
            </tr>  
        </table>
    
       <form method="POST" enctype="multipart/form-data">
            <label for="tipo"><h3>Tipo de produto</h3></label>
            <input type="tipo" name="tipo" id="tipo" placeholder="Tipo de produto" required/><br>

            <label><h3>Localização do ecoponto</h3></label>
            <select name="localizacao" id="localizacao">
                <?php
                    // Vai à base de dados buscar a localização dos ecopontos
                    $local = "select localizacao from `ecopontos`";
                    $resultlocal = mysqli_query($conn, $local);
                    // Percorre os dados e vai escrevendo no dropdown opções com as várias localizações dos ecopontos
                    while ($local = mysqli_fetch_array($resultlocal,MYSQLI_ASSOC)){?>
                        <option value="<?php echo $local["localizacao"];?>">
                            <?php echo $local["localizacao"];?>
                        </option>
                    <?php
                    }
                ?>
            </select><br>
                    
            <label for="file"><h3>Enviar imagem</h3></label>
            <input type="file" name="file" required><br><br>

            <input type="submit" name="submit" value="Enviar">

            <input type="reset" class="submit" value="Apagar Tudo">
            
            <h6>Ver o meu&nbsp;<a href="historicodes.php">Histórico</a> de roupas.</h6>
            <h6>Voltar à <a href="index.html">página inicial</a></h6>
        </form>
        <?php
        }
        ?>
    </div>
</body>
</html>