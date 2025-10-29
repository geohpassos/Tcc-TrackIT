

<?php

    require_once 'Conexao.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = ($_POST['nome']);
    $email = ($_POST['email']);
    $senha = ($_POST['senha']);
    $cod = ($_POST['codigo']);

    if (!empty($nome) && !empty($email) && !empty($senha) && !empty($cod)) {

        if ($cod === "@adm_2025") {

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "INSERT INTO administrador (nomeCompleto, email, senha) VALUES (:n, :e, :s)";
            $requisicao = $conexao->prepare($sql);
            $requisicao->bindParam(':n', $nome);
            $requisicao->bindParam(':e', $email);
            $requisicao->bindParam(':s', $senhaHash);

            try {
                $requisicao->execute();
                echo '
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Cadastro</title>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                </head>
                <body>
                    <script>
                        Swal.fire({
                            title: "Cadastro Realizado!",
                            text: "Cadastro concluído com sucesso.",
                            icon: "success",
                            confirmButtonText: "Ok"
                        }).then(() => {
                            window.location = "../html/loginAdm.html";
                        });
                    </script>
                </body>
                </html>';
            } catch (PDOException $e) {
                echo '
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Erro</title>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                </head>
                <body>
                    <script>
                        Swal.fire({
                            title: "Erro!",
                            text: "Não foi possível realizar o cadastro. Tente novamente.",
                            icon: "error",
                            confirmButtonText: "Ok"
                        });
                    </script>
                </body>
                </html>';
            }
        } else {
            echo '
            <!DOCTYPE html>
            <html>
            <head>
                <title>Código Inválido</title>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            </head>
            <body>
                <script>
                    Swal.fire({
                        title: "Código incorreto!",
                        text: "O código do administrador não confere.",
                        icon: "warning",
                        confirmButtonText: "Tentar novamente"
                    }).then(() => {
                        window.history.back();
                    });
                </script>
            </body>
            </html>';
        }
    } else {
        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Campos Vazios</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: "Atenção!",
                    text: "Preencha todos os campos antes de enviar.",
                    icon: "info",
                    confirmButtonText: "Ok"
                }).then(() => {
                    window.history.back();
                });
            </script>
        </body>
        </html>';
    }
}
?>


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../css/Cadastroadm.css">
    <link rel="shortcut icon" type="imagex/png" href="../LOJA/img/logo2.PNG" id="icon">
    <script src="../js/cadastro.js"></script>
</head>
<body class="principal">
    <div class="formulario">
        <form id="form-login" method="POST" action="../php/CadastroAdm.php">
            <div class="imagem">
            <img src="../img/logo.png" alt="">
            </div>
    <h3>CADASTRO ADMINISTRADOR</h3>
    
    <input type="tel" name="nome" placeholder="Nome Completo" id="nome" minlength="3">
    <br>
    <input type="text" name="email" placeholder="E-mail" id="adm"
     required="true" minlength="3">
    <br>
    <input type="password" name="senha" id="senha" placeholder="Senha" required="true" minlength="3">
    <br>
    <input type="tel" name="codigo" placeholder="Cogido Administrador" id="cod">
    <br>
    <a href="../html/loginAdm.html" id="link" >Login</a><br><br>
    <input type="submit" value="Cadastrar">

    <br>
    
</form>
</div>

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>