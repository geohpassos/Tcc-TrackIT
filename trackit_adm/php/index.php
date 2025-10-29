<?php
session_start();
require_once('Conexao.php');

$email = $_POST['email'];
$senha = $_POST['senha'];

if(!empty($email) && !empty($senha)){
    $sql = 'SELECT * FROM administrador WHERE email = :email';
    $requisicao = $conexao->prepare($sql);
    $requisicao->bindParam(':email',$email);
    $requisicao->execute();
    $adm = $requisicao->fetch(PDO::FETCH_ASSOC);
    if($adm && password_verify($senha, $adm['senha'])){
        $_SESSION ['adm_id'] = $adm['id'];
        $_SESSION ['adm_telefone'] = $adm['telefone'];
        header('location:Home.php');
        exit;
    }else{
        echo'Usuário ou senha incorretos, verifique os campos!';
    }
}else{
      echo'Preencha todos os campos.';
    }

?>