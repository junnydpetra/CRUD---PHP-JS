<?php

    include_once "conexao.php";

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (empty($dados['id'])) 
    {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
                                                    Erro: Tente mais tarde!</div>"];
    } else if (empty($dados['nome'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
                                                    Erro: Necessário informar o nome!</div>"];
    } elseif (empty($dados['email'])) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
                                                    Erro: Necessário informar o e-mail!</div>"];
    } else {
        $query_usuario = "UPDATE usuarios SET nome=:nome, email=:email WHERE id=:id";
        $edit_usuario = $conector->prepare($query_usuario);
        $edit_usuario->bindParam(':nome', $dados['nome']);
        $edit_usuario->bindParam(':email', $dados['email']);
        $edit_usuario->bindParam(':id', $dados['id']);
        $edit_usuario->execute();
    
        if ($edit_usuario->execute()) {
            $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>
                                                    Registro editado com sucesso!</div>"];
        } else {
            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
                                                    Falha ao editar registro!</div>"];
        }

    }


    echo json_encode($retorna);
?>