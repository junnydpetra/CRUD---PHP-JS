<?php
    include_once "conexao.php";

    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    if (!empty($id)) 
    {
        $query_usuario = "DELETE FROM usuarios WHERE id=:id";
        $result_usuario = $conector->prepare($query_usuario);
        $result_usuario->bindParam(':id', $id);
        $result_usuario->execute();

        if($result_usuario->execute())
        {
            $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>
                                                   Registro excluído com sucesso!</div>"];
        } else {
            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
                                              Erro: Falha ao excluir registro!</div>"];
        }
         
    } else {
        echo "<div class='alert alert-danger' role='alert'></div>";
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>
                                              Erro: Usuário não encontrado!</div>"];
    }                                           

    echo json_encode($retorna);
