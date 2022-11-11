const tbody = document.querySelector(".listar-usuarios");
const cadForm = document.getElementById("cad-usuario-form");
const editForm = document.getElementById("edit-usuario-form");
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");
const msgAlerta = document.getElementById("msgAlerta");
const cadModal = new bootstrap.Modal(document.getElementById("cadUsuarioModal"));

const listarUsuarios = async (pagina) => {
    const dados = await fetch("./list.php?pagina=" + pagina);
    const resposta = await dados.text();
    tbody.innerHTML = resposta;
}

listarUsuarios(1);

cadForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    
    document.getElementById("cad-usuario-btn").value = "Salvando...";

    if(document.getElementById("nome").value === "")
    {
        console.log("Erro: Necessário informar o nome!");
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário informar o nome 1!</div>";
    } else if(document.getElementById("email").value === "") {
        console.log("Erro: Necessário informar o e-mail!");
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário informar o e-mail 1!</div>";
    } else {    

        const dadosForm = new FormData(cadForm);
        dadosForm.append("add", 1);
    

        const dados = await fetch("cadastrar.php", {
            method:"POST",
            body: dadosForm,
        });

        const resposta = await dados.json();
        
        if (resposta['erro']) {
            msgAlertaErroCad.innerHTML = resposta['msg'];
        } else {
            msgAlerta.innerHTML = resposta['msg'];
            cadForm.reset();
            cadModal.hide(); 
            listarUsuarios(1);
        }

    }

    document.getElementById("cad-usuario-btn").value = "Salvar";
});

async function visualizarUsuario(id) 
{
    const dados = await fetch('visualizar.php?id=' + id);
    const resposta = await dados.json();

    if(resposta['erro'])
    {
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const visualizarModal = new bootstrap.Modal(document.getElementById("visualizarUsuarioModal"));
        visualizarModal.show();

        document.getElementById("idUsuario").innerHTML = resposta['dados'].id;
        document.getElementById("nomedUsuario").innerHTML = resposta['dados'].nome;
        document.getElementById("emailUsuario").innerHTML = resposta['dados'].email;
    }
}

async function editarUsuarioDados(id)
{
    msgAlertaErroEdit.innerHTML = "";   

    const dados = await fetch('visualizar.php?id=' + id);
    const resposta = await dados.json();
    console.log(resposta);

    if(resposta['erro'])
    {
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const editModal = new bootstrap.Modal(document.getElementById("editUsuarioModal"));
        editModal.show();
        document.getElementById("editid").value = resposta['dados'].id;
        document.getElementById("editnome").value = resposta['dados'].nome;
        document.getElementById("editemail").value = resposta['dados'].email;
    }
 
}

editForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("edit-usuario-btn").value = "Salvando...";

    const dadosForm = new FormData(editForm);
    console.log(dadosForm); 

    const dados = await fetch("editar.php", {
        method: "POST",
        body:dadosForm
    });

    const resposta = await dados.json();
    console.log(resposta);
   
    if (resposta['erro']) 
    {
        msgAlertaErroEdit.innerHTML = resposta['msg'];
    } else {
        msgAlertaErroEdit.innerHTML = resposta['msg'];
        listarUsuarios(1);
    }
    
    document.getElementById("edit-usuario-btn").value = "Salvar";
});


async function excluirUsuarioDados(id) 
{
    var confirmar = confirm("ATENÇÃO: Tem certeza que deseja excluir o registro selecionado?");

    if (confirmar == true) 
    {
        const dados = await fetch("excluir.php?id=" + id);
        const resposta = await dados.json();
    
        if(resposta['erro']) 
        {
            msgAlerta.innerHTML = resposta['msg'];
        } else {
            msgAlerta.innerHTML = resposta['msg'];
            listarUsuarios(1);
        }
    }
    
    
}

