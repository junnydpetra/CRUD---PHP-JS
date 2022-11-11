<?php
    include_once "conexao.php";

    $pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

    if (!empty($pagina)) 
    {
        $quantidade_por_paginas = 40;
        $inicio = ($pagina * $quantidade_por_paginas) - $quantidade_por_paginas;
        
        $query_usuarios = "SELECT id, nome, email FROM usuarios ORDER BY id DESC LIMIT $inicio, $quantidade_por_paginas";
        $result_usuarios = $conector->prepare($query_usuarios);
        $result_usuarios->execute();

        $dados = "<div class='table-responsive'>
                    <table class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody class='table-group-divider'>";
                        
        while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) 
        {
            extract($row_usuario);
            $dados .="<tr>
                        <td>$id</td>
                        <td>$nome</td>
                        <td>$email</td>
                        <td>
                            <button id='$id' class='btn btn-outline-primary btn-sm'
                            onclick='visualizarUsuario($id)'>Visualizar</button>

                            <button id='$id' class='btn btn-outline-warning btn-sm'
                            onclick='editarUsuarioDados($id)'>Editar</button>
                            
                            <button id='$id' class='btn btn-outline-danger btn-sm'
                            onclick='excluirUsuarioDados($id)'>Excluir</button>
                        </td>
                    </tr>";
        } 

        $dados .= "</tbody>
                </table>
            </div>";

        //Pagination - Check number of users
        $query_pg = "SELECT COUNT(id) AS num_result FROM usuarios";
        $result_pg = $conector->prepare($query_pg);
        $result_pg->execute();
        $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

        //Pagination - Check number of pages
        $numero_de_paginas = ceil($row_pg['num_result']/$quantidade_por_paginas);

            $max_links = 2;

            $dados .= '<nav aria-label="Page navigation example"><ul class="pagination pagination-sm
            justify-content-center">';
            $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuarios(1)'>Primeira</a></li>";
            
            for ($pag_antes = $pagina - $max_links; $pag_antes <= $pagina - 1; $pag_antes++) 
            {
                if ($pag_antes >= 1) 
                {
                    $dados .= "<li class='page-item'><a class='page-link'
                    href='#' onclick='listarUsuarios($pag_antes)'>$pag_antes</a></li>";
                }
            }

            $dados .= "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

            for ($pag_seguinte = $pagina + 1; $pag_seguinte <= $pagina + $max_links; $pag_seguinte++) 
            {
                if ($pag_seguinte <= $numero_de_paginas) 
                {
                    $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuarios($pag_seguinte)
                    '>$pag_seguinte</a></li>";
                }
            }

            $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuarios($numero_de_paginas)'>Última</a></li>";
            $dados .= '</ul></nav>';
    
        echo $dados;
    
    } else {
        echo "<div class='alert alert-danger' role='alert'>Usuário não encontrado!</div>";
    }
