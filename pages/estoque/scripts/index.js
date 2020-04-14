const adicionou = document.getElementById("adicionou")
adicionou.style.display = 'none'


function carregar() {
    axios({
        method: 'get',
        url: '/services/produtos/',
    })
  
    .then(function (response) {
        json = response.data
        console.log(json)

        for(var i in json) {
            let id_produto = json[i].id_produto
            let produto = json[i].produto
            let preco = json[i].preco
            let descricao = json[i].descricao
            let quantidade = json[i].quantidade
            
            console.log(descricao)
            let tr = `
            <tr id="tr${id_produto}">
                <th scope="row">${produto}</th>
                <td>${preco}</td>
                <td>${quantidade}</td>
                <td>
                    <a type="button" class="btn btn-secondary text-white" data-toggle="modal" data-target="#modal${id_produto}">
                        <i class="far fa-edit"></i>
                    </a>
                    <a onclick="deletarProduto('${id_produto}')" type="button" class="btn btn-danger text-white">
                        <i class="far fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            `
            let modalIdProduto = `
            <div class="modal fade" id="modal${id_produto}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adicional Produto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Produto:</label>
                                <input type="text" class="form-control" id="${id_produto}Nome" value="${produto}">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Descrição:</label>
                                <textarea class="form-control" id="${id_produto}Descricao" >${descricao}</textarea>
                            </div>
                            <div class="form-group">
                            <div class="form-row">
                                <div class="form-group col-sm-3">
                                        <label for="produtoPreco">Preço</label>
                                        <input type="number" class="form-control" id="${id_produto}Preco" value="${preco}" >
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="produtoQuantidade">Quantidade</label>
                                        <input type="number" class="form-control" id="${id_produto}Quantidade" value="${quantidade}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button onclick="editarProduto('${id_produto}')" type="button" class="btn btn-success">Editar</button>
                    </div>
                    </div>
                </div>
            </div>
            `
            $("#tbody").append(tr)
            $("#tbody").append(modalIdProduto)

        }
            
    });
}






function enviar() {
    axios({
        method: 'put',
        url: '/services/produtos/',
        data: {
            id_produto: id_produto,
            produto: produto,
            preco: preco,
            quantidade: quantidade,
            descricao: descricao
        }
    })
}

function adicionarProduto() {
    var produto = document.getElementById("produtoNome").value
    var descricao = document.getElementById("produtoDescricao").value
    var preco = document.getElementById("produtoPreco").value
    var quantidade = document.getElementById("produtoQuantidade").value



    axios({
        method: 'post',
        url: '/services/produtos/',
        data: {
            produto: produto,
            preco: preco,
            quantidade: quantidade,
            descricao: descricao
        }
    })
    
    .then(function (response) {
        var json = response.data
        
        if(json.id_produto != null && json.id_produto != undefined)
            adicionou.style.display = 'block'

            
    })

    .catch(function (error) {
    console.log(error);
    })

   
}


function editarProduto(id_produto) {
    var produto = document.getElementById(`${id_produto}Nome`).value
    var descricao = document.getElementById(`${id_produto}Descricao`).value
    var preco = document.getElementById(`${id_produto}Preco`).value
    var quantidade = document.getElementById(`${id_produto}Quantidade`).value

    console.log( produto,
    descricao,
        preco,
        quantidade)


    axios({
        method: 'put',
        url: '/services/produtos/',
        data: {
            id_produto: id_produto,
            produto: produto,
            preco: preco,
            quantidade: quantidade,
            descricao: descricao
        }
    })
    

   
}



function deletarProduto(id_produto) {
    $(`#tr${id_produto}`).remove()
    
    axios({
        method: 'delete',
        url: '/services/produtos/',
        data: {
            id_produto: id_produto,
        }
    })
    

   
}
