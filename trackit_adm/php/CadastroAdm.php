<?php

    require_once 'Conexao.php';


    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];


    if(!empty($email) && !empty($telefone) && !empty($senha)){
        //pegamos a senha digitada pelo usuario e realizamos uma criptografia nela
        //com base nisso, vamos armazenar o HASH(criptografia) no banco de dados.
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        //instrução DML
        $sql = "INSERT INTO usuarios (email,telefone,senha) VALUES (:email,:telefone, :senha)";

        //preparar a inserção de dados no banco
        $requisicao = $conexao->prepare($sql);

        $requisicao->bindParam(':email',$email);
        $requisicao->bindParam(':telefone',$telefone);
        $requisicao->bindParam(':senha',$senhaHash);

        try{
            $requisicao->execute();
             echo' <!DOCTYPE html>
    <html>
    <head>
        <title>Cadastro</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <script type="text/javascript">
            Swal.fire({
                title: "Cadastro Realizado",
                text: "Cadastro concluído com Sucesso.",
                icon: "success",
                confirmButtonText: "Produtos",
            }).then(function() {
                window.location = "http://localhost/login_cadastro/html/cadastroUsuario.html";
            });
        </script>
    </body>
    </html>';

        }catch(PDOException $e){
             echo ' <!DOCTYPE html>
    <html>
    <head>
        <title>Cadastro</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <script type="text/javascript">
              Swal.fire({
            title: "Erro!",
            text: "Erro na finalização",
            icon: "error",
            confirmButtonText: "Tente Novamente"

        })
        </script>
    </body>
    </html>'.$e ->getMessage();
        }
    }else{
        echo '<p style="color:red"> PREENCHA TODOS OS CAMPOS!</p>';
    }

?>