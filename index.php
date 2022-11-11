<?php
    include_once"conexao.php";
?>


<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="imagens/icone.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
        crossorigin="anonymous">
        <title>CRUD - PHP FETCH</title>
    </head>
    
    <body>
        <div class="container">
            <div class="row mt-4">
                <div class="col-lg-12 d-flex justify-content-between align-items-center">
                    <h4>Lista de Usuários:</h4>
                    
                    <div>
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" 
                        data-bs-target="#cadUsuarioModal">
                            Cadastrar
                        </button>
                    </div>
                    
                </div>
            </div>
            
            <hr>

            <span id="msgAlerta"></span>

            <div class="row">
                <div class="col-lg-12">
                    <span class="listar-usuarios"></span>
                </div>
            </div>

        </div>

        <div class="modal fade" id="cadUsuarioModal" tabindex="-1" aria-labelledby="cadUsuarioModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="cadUsuarioModalLabel">Cadastrar Usuário</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="cad-usuario-form">
                            <span id="msgAlertaErroCad"></span>
                            <div class="mb-3">
                                <label for="nome" class="col-form-label">Nome:</label>
                                <input type="text" name="nome" class="form-control" id="nome"
                                placeholder="Informe o nome completo">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="col-form-label">E-Mail:</label>
                                <input type="email" name="email" class="form-control" id="email"
                                placeholder="Informe o e-mail de sua preferência">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger btn-sm" 
                                data-bs-dismiss="modal">Cancelar</button>
                                <input type="submit" class="btn btn-outline-success btn-sm" 
                                id="cad-usuario-btn" value="Salvar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="visualizarUsuarioModal" tabindex="-1" aria-labelledby="visualizarUsuarioModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="visualizarUsuarioModalLabel">Detalhes Do Usuário</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span id="msgAlertaErroVisualizar"></span>
                        
                        <dl class="row">
                            <dt class="col-sm-3">ID:</dt>
                            <dd class="col-sm-9"><span id="idUsuario"></span></dd>

                            <dt class="col-sm-3">Nome:</dt>
                            <dd class="col-sm-9"><span id="nomedUsuario"></span></dd>

                            <dt class="col-sm-3">E-Mail:</dt>
                            <dd class="col-sm-9"><span id="emailUsuario"></span></dd>
                        </dl>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editUsuarioModal" tabindex="-1" aria-labelledby="editUsuarioModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editUsuarioModalLabel">Editar Usuário</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-usuario-form">
                            <span id="msgAlertaErroEdit"></span>

                            <input type="hidden" name="id" id="editid">

                            <div class="mb-3">
                                <label for="nome" class="col-form-label">Nome:</label>
                                <input type="text" name="nome" class="form-control" id="editnome"
                                placeholder="Informe o nome completo">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="col-form-label">E-Mail:</label>
                                <input type="email" name="email" class="form-control" id="editemail"
                                placeholder="Informe o e-mail de sua preferência">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary btn-sm" 
                                data-bs-dismiss="modal">Cancelar</button>
                                <input type="submit" class="btn btn-outline-warning btn-sm"
                                id="edit-usuario-btn" value="Salvar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
        crossorigin="anonymous"></script>
        <script src="js/custom.js"></script>
    </body>

</html>