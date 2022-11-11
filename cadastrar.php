<?php

    include_once "conexao.php";

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (empty($dados['nome'])) 
    {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
                                                    Erro: Necessário informar o nome!</div>"];
    } elseif (empty($dados['email'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
                                                    Erro: Necessário informar o e-mail!</div>"];
    } else {
        
        $query_usuario = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email)";
        $cad_usuario = $conector->prepare($query_usuario);
        $cad_usuario->bindParam(':nome', $dados['nome']);
        $cad_usuario->bindParam(':email', $dados['email']);
    
        $cad_usuario->execute();
    
        if ($cad_usuario->rowCount()) {
            $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>
                                                    Usuário cadastrado com sucesso!</div>"];
        } else {
            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
                                                    Falha ao cadastrar usuário!</div>"];
        }

    }


    echo json_encode($retorna);
?>