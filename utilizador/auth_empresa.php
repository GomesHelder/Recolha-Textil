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
    // Estabelece ligação à base de dados
    require("liga_BD.php");
    // Inicia sessão e verifica se tem sessão iniciada
    session_start();
    // Tem sessão iniciada
    if(isset($_SESSION["email"])) {
        // Atribui à variável o email do utilizador que está logado
        $email = $_SESSION["email"];
        // Vai buscar à base de dados os dados da Empresa dona dos Ecopontos e verifica se o utilizador tem sessão iniciada como Empresa
        $sql = "select * from `empresa_ecopontos` where email='$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if ($row["nome"] == null) {
            ?>
            <h4>Como não tem sessão iniciada como Empresa, não pode aceder a esta página!</h4><br>
            Clique <a href="" onclick="return voltar()">aqui</a> para voltar! <?php
            exit();
        }
    // Não tem sessão iniciada
    }else{
        ?>
        Precisa de ter sessão iniciada como Empresa para aceder a esta página <br>
        Faça o <a href="utilizador/login_empresa.php">login</a> aqui! <?php
        exit();
    }
?>