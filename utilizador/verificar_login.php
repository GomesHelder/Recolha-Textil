<script>
    // Função para voltar para página anterior
    function voltar() {
        history.go(-1);
        return false;
    }
</script>
<?php
    // Desliga os erros do php
    error_reporting(0);
    // Inicia sessão e verifica se tem sessão iniciada
    session_start();
    // Estabelece ligação à base de dados
    require("liga_BD.php");
    // Tem sessão iniciada
    if(isset($_SESSION["email"])) {
        // Atribui à variável o email do utilizador que está logado
        $email = $_SESSION["email"];
        // Vai à base de dados buscar dados dos Munícipes e da Empresa
        $sql1 = "select * from municipe where email = '$email'";
        $sql2 = "select * from empresa_ecopontos where email = '$email'";
        $result1 = mysqli_query($conn, $sql1);
        $result2 = mysqli_query($conn, $sql2);
        $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        // Se tiver sessão iniciada como Empresa
        if($row1['nome'] == null){
            ?>
            <h4>Já tem sessão iniciada como <?php echo $row2['nome']; ?></h4>
            Clique <a href="" onclick="return voltar()">aqui</a> para voltar!<br>
            Clique <a href="logout.php">aqui</a> para terminar sessão!<?php
            exit();
        // Se tiver sessão iniciada como Municípe
        }else{
            ?>
            <h4>Já tem sessão iniciada como <?php echo $row1['nome']; echo '&nbsp;'; echo $row1['apelido'];?></h4>
            Clique <a href="" onclick="return voltar()">aqui</a> para voltar!<br>
            Clique <a href="logout.php">aqui</a> para terminar sessão!<?php
            exit();
        }
    }
?>